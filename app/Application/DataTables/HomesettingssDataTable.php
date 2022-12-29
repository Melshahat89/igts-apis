<?php

namespace App\Application\DataTables;

use App\Application\Model\Homesettings;
use Yajra\Datatables\Services\DataTable;

class HomesettingssDataTable extends DataTable
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
              ->addColumn('id', 'admin.homesettings.buttons.id')
             ->addColumn('edit', 'admin.homesettings.buttons.edit')
             ->addColumn('delete', 'admin.homesettings.buttons.delete')
             ->addColumn('view', 'admin.homesettings.buttons.view')
             /*->addColumn('name', 'admin.homesettings.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Homesettings::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("bundles") && request()->get("bundles") != ""){
				$query = $query->where("bundles","=", request()->get("bundles"));
		}

		if(request()->has("featured_courses") && request()->get("featured_courses") != ""){
				$query = $query->where("featured_courses","=", request()->get("featured_courses"));
		}

		if(request()->has("events") && request()->get("events") != ""){
				$query = $query->where("events","=", request()->get("events"));
		}

		if(request()->has("talks") && request()->get("talks") != ""){
				$query = $query->where("talks","=", request()->get("talks"));
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
                'name' => 'bundles',
                'data' => 'bundles',
                'title' => "bundles",
                
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
        return 'Homesettingsdatatables_' . time();
    }
}