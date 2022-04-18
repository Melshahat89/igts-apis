<?php

namespace App\Application\DataTables;

use App\Application\Model\Eventsdata;
use Yajra\Datatables\Services\DataTable;

class EventsdatasDataTable extends DataTable
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
              ->addColumn('id', 'admin.eventsdata.buttons.id')
             ->addColumn('edit', 'admin.eventsdata.buttons.edit')
             ->addColumn('delete', 'admin.eventsdata.buttons.delete')
             ->addColumn('view', 'admin.eventsdata.buttons.view')
             /*->addColumn('name', 'admin.eventsdata.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Eventsdata::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("name") && request()->get("name") != ""){
				$query = $query->where("name","like", "%".request()->get("name")."%");
		}

		if(request()->has("email") && request()->get("email") != ""){
				$query = $query->where("email","=", request()->get("email"));
		}

		if(request()->has("website") && request()->get("website") != ""){
				$query = $query->where("website","=", request()->get("website"));
		}

		if(request()->has("about") && request()->get("about") != ""){
				$query = $query->where("about","like", "%".request()->get("about")."%");
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
                'title' => trans("eventsdata.name"),
                // 'render' => 'function(){
                //         return JSON.parse(this.name).'.getCurrentLang().';
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
        return 'Eventsdatadatatables_' . time();
    }
}