<?php

namespace App\Application\DataTables;

use App\Application\Model\Quiz;
use Yajra\Datatables\Services\DataTable;

class QuizsDataTable extends DataTable
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
              ->addColumn('id', 'admin.quiz.buttons.id')
             ->addColumn('edit', 'admin.quiz.buttons.edit')
             ->addColumn('delete', 'admin.quiz.buttons.delete')
             ->addColumn('view', 'admin.quiz.buttons.view')
             /*->addColumn('name', 'admin.quiz.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Quiz::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("title") && request()->get("title") != ""){
				$query = $query->where("title","like", "%".request()->get("title")."%");
		}

		if(request()->has("description") && request()->get("description") != ""){
				$query = $query->where("description","like", "%".request()->get("description")."%");
		}

		if(request()->has("instructions") && request()->get("instructions") != ""){
				$query = $query->where("instructions","=", request()->get("instructions"));
		}

		if(request()->has("time") && request()->get("time") != ""){
				$query = $query->where("time","=", request()->get("time"));
		}

		if(request()->has("time_in_mins") && request()->get("time_in_mins") != ""){
				$query = $query->where("time_in_mins","=", request()->get("time_in_mins"));
		}

		if(request()->has("type") && request()->get("type") != ""){
				$query = $query->where("type","=", request()->get("type"));
		}

		if(request()->has("pass_percentage") && request()->get("pass_percentage") != ""){
				$query = $query->where("pass_percentage","=", request()->get("pass_percentage"));
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
                'name' => 'title',
                'data' => 'title',
                'title' => trans("quiz.title"),
                // 'render' => 'function(){
                //         return JSON.parse(this.title).'.getCurrentLang().';
                //     }',
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
        return 'Quizdatatables_' . time();
    }
}