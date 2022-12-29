<?php

namespace App\Application\DataTables;

use App\Application\Model\Lecturequestions;
use Yajra\Datatables\Services\DataTable;

class LecturequestionssDataTable extends DataTable
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
              ->addColumn('id', 'admin.lecturequestions.buttons.id')
              ->addColumn('email', 'admin.lecturequestions.buttons.email')
              ->addColumn('answer', 'admin.lecturequestions.buttons.answer')
              ->addColumn('course', 'admin.lecturequestions.buttons.course')
              ->addColumn('instructor', 'admin.lecturequestions.buttons.instructor')
             ->addColumn('edit', 'admin.lecturequestions.buttons.edit')
             ->addColumn('delete', 'admin.lecturequestions.buttons.delete')
             ->addColumn('view', 'admin.lecturequestions.buttons.view')
             /*->addColumn('name', 'admin.lecturequestions.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Lecturequestions::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("question_title") && request()->get("question_title") != ""){
				$query = $query->where("question_title","=", request()->get("question_title"));
		}

		if(request()->has("question_description") && request()->get("question_description") != ""){
				$query = $query->where("question_description","=", request()->get("question_description"));
		}

		if(request()->has("approve") && request()->get("approve") != ""){
				$query = $query->where("approve","=", request()->get("approve"));
		}

        if(request()->has("answered") && request()->get("answered") != ""){

            if(request()->get('answered') == 1){
                $query = $query->whereHas('lecturequestionsanswers', function($q){
                    $q->where('is_instructor', 1);
                });
            }else{

                $query = $query->doesnthave('lecturequestionsanswers', 'or', function($q){
                    $q->where('is_instructor', '!=', 0);
                });
            }

        
        if(request()->has('course') && request()->get('course') != ""){
            $query = $query->whereHas('courselectures', function($q){
                $q->where('courses_id', request()->get('course'));
            });
        }
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
                'name' => 'email',
                'data' => 'email',
                'title' => "User Email",
                "orderable" => false,

                ],

			[
                'name' => 'question_title',
                'data' => 'question_title',
                'title' => "question_title",
                "orderable" => false,

                ],
                [
                    'name' => 'answer',
                    'data' => 'answer',
                    'title' => "Instructor Answer",
                    "orderable" => false,

                    ],
                    [
                        'name' => 'course',
                        'data' => 'course',
                        'title' => "Course",
                        "orderable" => false,
    
                        ],
                        [
                            'name' => 'instructor',
                            'data' => 'instructor',
                            'title' => "Instructor",
                            "orderable" => false,
        
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
             [
                  'name' => 'edit',
                  'data' => 'edit',
                  'title' =>  trans('curd.edit'),
                  'exportable' => false,
                  'printable' => false,
                  'searchable' => false,
                  'orderable' => false,
             ],
             [
                   'name' => 'delete',
                   'data' => 'delete',
                   'title' => trans('curd.delete'),
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
        return 'Lecturequestionsdatatables_' . time();
    }
}