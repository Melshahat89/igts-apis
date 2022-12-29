<?php

namespace App\Application\DataTables;

use App\Application\Model\Categories;
use Yajra\Datatables\Services\DataTable;

class CategoriessDataTable extends DataTable
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
              ->addColumn('id', 'admin.categories.buttons.id')
             ->addColumn('edit', 'admin.categories.buttons.edit')
             ->addColumn('delete', 'admin.categories.buttons.delete')
             ->addColumn('view', 'admin.categories.buttons.view')
             /*->addColumn('name', 'admin.categories.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Categories::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("name") && request()->get("name") != ""){
				$query = $query->where("name","like", "%".request()->get("name")."%");
		}

		if(request()->has("slug") && request()->get("slug") != ""){
				$query = $query->where("slug","=", request()->get("slug"));
		}

		if(request()->has("desc") && request()->get("desc") != ""){
				$query = $query->where("desc","like", "%".request()->get("desc")."%");
		}

		if(request()->has("parent_id") && request()->get("parent_id") != ""){
				$query = $query->where("parent_id","=", request()->get("parent_id"));
		}

		if(request()->has("sort") && request()->get("sort") != ""){
				$query = $query->where("sort","=", request()->get("sort"));
		}

		if(request()->has("status") && request()->get("status") != ""){
				$query = $query->where("status","=", request()->get("status"));
		}

		if(request()->has("show_home") && request()->get("show_home") != ""){
				$query = $query->where("show_home","=", request()->get("show_home"));
		}

		if(request()->has("show_menu") && request()->get("show_menu") != ""){
				$query = $query->where("show_menu","=", request()->get("show_menu"));
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
                'name' => 'name',
                'data' => 'name',
                'title' => trans("categories.name"),
                'render' => 'function(){
                        return JSON.parse(this.name).'.getCurrentLang().';
                    }',
                ],

                [
                    'name' => 'sort',
                    'data' => 'sort',
                    'title' => 'Sort',

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
        return 'Categoriesdatatables_' . time();
    }
}