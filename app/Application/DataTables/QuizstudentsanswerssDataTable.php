<?php

namespace App\Application\DataTables;

use App\Application\Model\Quizstudentsanswers;
use Yajra\Datatables\Services\DataTable;

class QuizstudentsanswerssDataTable extends DataTable
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
              ->addColumn('id', 'admin.quizstudentsanswers.buttons.id')
             ->addColumn('edit', 'admin.quizstudentsanswers.buttons.edit')
             ->addColumn('delete', 'admin.quizstudentsanswers.buttons.delete')
             ->addColumn('view', 'admin.quizstudentsanswers.buttons.view')
             /*->addColumn('name', 'admin.quizstudentsanswers.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Quizstudentsanswers::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("is_correct") && request()->get("is_correct") != ""){
				$query = $query->where("is_correct","=", request()->get("is_correct"));
		}

		if(request()->has("answered") && request()->get("answered") != ""){
				$query = $query->where("answered","=", request()->get("answered"));
		}

		if(request()->has("mark") && request()->get("mark") != ""){
				$query = $query->where("mark","=", request()->get("mark"));
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
                'name' => 'is_correct',
                'data' => 'is_correct',
                'title' => "is_correct",
                
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
        return 'Quizstudentsanswersdatatables_' . time();
    }
}