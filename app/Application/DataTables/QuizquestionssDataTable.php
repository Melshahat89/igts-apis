<?php

namespace App\Application\DataTables;

use App\Application\Model\Quizquestions;
use Yajra\Datatables\Services\DataTable;

class QuizquestionssDataTable extends DataTable
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
              ->addColumn('id', 'admin.quizquestions.buttons.id')
             ->addColumn('edit', 'admin.quizquestions.buttons.edit')
             ->addColumn('delete', 'admin.quizquestions.buttons.delete')
             ->addColumn('view', 'admin.quizquestions.buttons.view')
             /*->addColumn('name', 'admin.quizquestions.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Quizquestions::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("question") && request()->get("question") != ""){
				$query = $query->where("question","like", "%".request()->get("question")."%");
		}

		if(request()->has("type") && request()->get("type") != ""){
				$query = $query->where("type","=", request()->get("type"));
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
                'name' => 'question',
                'data' => 'question',
                'title' => trans("quizquestions.question"),
                'render' => 'function(){
                        return JSON.parse(this.question).'.getCurrentLang().';
                    }',
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
        return 'Quizquestionsdatatables_' . time();
    }
}