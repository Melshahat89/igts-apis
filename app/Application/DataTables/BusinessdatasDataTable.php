<?php

namespace App\Application\DataTables;

use App\Application\Model\Businessdata;
use Yajra\Datatables\Services\DataTable;

class BusinessdatasDataTable extends DataTable
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
              ->addColumn('id', 'admin.businessdata.buttons.id')
             ->addColumn('edit', 'admin.businessdata.buttons.edit')
             ->addColumn('delete', 'admin.businessdata.buttons.delete')
             ->addColumn('view', 'admin.businessdata.buttons.view')
             ->addColumn('user', 'admin.businessdata.buttons.user')
             /*->addColumn('name', 'admin.businessdata.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Businessdata::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("name") && request()->get("name") != ""){
				$query = $query->where("name","like", "%".request()->get("name")."%");
		}

		if(request()->has("discount_type") && request()->get("discount_type") != ""){
				$query = $query->where("discount_type","=", request()->get("discount_type"));
		}

		if(request()->has("discount_value") && request()->get("discount_value") != ""){
				$query = $query->where("discount_value","=", request()->get("discount_value"));
		}

		if(request()->has("automatically_license") && request()->get("automatically_license") != ""){
				$query = $query->where("automatically_license","=", request()->get("automatically_license"));
		}

		if(request()->has("status") && request()->get("status") != ""){
				$query = $query->where("status","=", request()->get("status"));
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
                'title' => trans("businessdata.name"),
                'render' => 'function(){
                        return JSON.parse(this.name).'.getCurrentLang().';
                    }',
                ],
                [
                    'name' => 'user_id',
                    'data' => 'user',
                    'title' => 'user',
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
        return 'Businessdatadatatables_' . time();
    }
}