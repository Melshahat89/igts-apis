<?php

namespace App\Application\DataTables;

use App\Application\Model\Ticketsreplay;
use Yajra\Datatables\Services\DataTable;

class TicketsreplaysDataTable extends DataTable
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
              ->addColumn('id', 'admin.ticketsreplay.buttons.id')
             ->addColumn('edit', 'admin.ticketsreplay.buttons.edit')
             ->addColumn('delete', 'admin.ticketsreplay.buttons.delete')
             ->addColumn('view', 'admin.ticketsreplay.buttons.view')
             ->addColumn('ticket', 'admin.ticketsreplay.buttons.ticket')
             /*->addColumn('name', 'admin.ticketsreplay.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Ticketsreplay::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("message") && request()->get("message") != ""){
				$query = $query->where("message","=", request()->get("message"));
		}

		if(request()->has("reciver_id") && request()->get("reciver_id") != ""){
				$query = $query->where("reciver_id","=", request()->get("reciver_id"));
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
                'name' => 'message',
                'data' => 'message',
                'title' => "message",
                
                ],
                [
                    'name' => 'ticket',
                    'data' => 'ticket',
                    'title' => "ticket",
                    
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
        return 'Ticketsreplaydatatables_' . time();
    }
}