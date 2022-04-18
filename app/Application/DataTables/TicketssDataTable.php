<?php

namespace App\Application\DataTables;

use App\Application\Model\Tickets;
use Yajra\Datatables\Services\DataTable;

class TicketssDataTable extends DataTable
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
              ->addColumn('id', 'admin.tickets.buttons.id')
             ->addColumn('edit', 'admin.tickets.buttons.edit')
             ->addColumn('delete', 'admin.tickets.buttons.delete')
             ->addColumn('view', 'admin.tickets.buttons.view')
             ->addColumn('sender', 'admin.tickets.buttons.sender')
             
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Tickets::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("reciver_id") && request()->get("reciver_id") != ""){
				$query = $query->where("reciver_id","=", request()->get("reciver_id"));
		}

		if(request()->has("status") && request()->get("status") != ""){
				$query = $query->where("status","=", request()->get("status"));
		}

		if(request()->has("type") && request()->get("type") != ""){
				$query = $query->where("type","=", request()->get("type"));
		}

		if(request()->has("title") && request()->get("title") != ""){
				$query = $query->where("title","=", request()->get("title"));
		}

		if(request()->has("message") && request()->get("message") != ""){
				$query = $query->where("message","=", request()->get("message"));
		}

		if(request()->has("priority") && request()->get("priority") != ""){
				$query = $query->where("priority","=", request()->get("priority"));
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
                'name' => 'sender',
                'data' => 'sender',
                'title' => "Sender",
                
                ],
                [
                    'name' => "title",
                    'data' => 'title',
                    'title' => 'Title',
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
            //  [
            //       'name' => 'edit',
            //       'data' => 'edit',
            //       'title' =>  trans('curd.edit'),
            //       'exportable' => false,
            //       'printable' => false,
            //       'searchable' => false,
            //       'orderable' => false,
            //  ],
            //  [
            //        'name' => 'delete',
            //        'data' => 'delete',
            //        'title' => trans('curd.delete'),
            //        'exportable' => false,
            //        'printable' => false,
            //        'searchable' => false,
            //        'orderable' => false,
            //  ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ticketsdatatables_' . time();
    }
}