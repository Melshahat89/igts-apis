<?php

namespace App\Application\DataTables;

use App\Application\Model\Quizstudentsstatus;
use Yajra\Datatables\Services\DataTable;

class QuizstudentsstatussDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
             ->eloquent($this->query())
             ->editColumn('start_time', function ($request) {
                 return ($request->start_time) ? date('d-m-y h:m A', $request->start_time) : '';
              })
              ->editColumn('end_time', function ($request) {
                return ($request->end_time) ? date('d-m-y h:m A', $request->end_time) : '';
             })
             ->editColumn('status', function ($request) {
                return ($request->status == 4 && $request->passed == 1) ? 'Passed' : (($request->status == 4 && $request->passed != 1) ? 'Failed' : 'In Progress');
             })
             ->addColumn('id', 'admin.quizstudentsstatus.buttons.id')
             ->addColumn('view', 'admin.quizstudentsstatus.buttons.view')
             ->addColumn('user', 'admin.quizstudentsstatus.buttons.user')
             ->addColumn('quiz', 'admin.quizstudentsstatus.buttons.quiz')
             ->addColumn('reexam', function ($request){
                 return ($request->status == 4 && $request->passed == 0 && $request->exam_anytime == 0) ? '<a href="quizstudentsstatus/' . $request->id . '/reexam" class="btn btn-warning btn-circle waves-effect waves-circle waves-float"><i class="material-icons">autorenew</i></a>' : (($request->exam_anytime == 1) ? 'May Re-Exam' : '');
             })

             /*->addColumn('name', 'admin.quizstudentsstatus.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Quizstudentsstatus::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

        if (request()->has("email") && request()->get("email") != "") {
            $query = $query->whereHas('user', function($q){
                $q->where('email', 'LIKE', '%' . request()->get("email") . '%' );
            });
        }

        

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters(dataTableConfig());
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
              [
                  'name' => "id",
                  'data' => 'id',
                  'title' => trans('curd.id'),
             ],

                [
                    'name' => 'user',
                    'data' => 'user',
                    'title' => 'User',
                ],
                [
                    'name' => 'quiz',
                    'data' => 'quiz',
                    'title' => 'Quiz',
                ],
                [
                    'name' => 'start_time',
                    'data' => 'start_time',
                    'title' => "start_time",
                    
                ],
                [
                    'name' => 'end_time',
                    'data' => 'end_time',
                    'title' => "end_time",
                
                ],
                [
                    'name' => 'status',
                    'data' => 'status',
                    'title' => "Status",
                
                ],
                [
                    'name' => 'reexam',
                    'data' => 'reexam',
                    'title' => 'Re-Exam',
                    'exportable' => false,
                    'printable' => false,
                    'searchable' => false,
                    'orderable' => false,
                ],
             [
                  'name' => 'view',
                  'data' => 'view',
                  'title' => trans('curd.view'),
                  'exportable' => false,
                  'printable' => false,
                  'searchable' => false,
                  'orderable' => false,
             ],
           

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Quizstudentsstatusdatatables_' . time();
    }
}