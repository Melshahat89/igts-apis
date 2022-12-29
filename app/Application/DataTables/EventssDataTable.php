<?php

namespace App\Application\DataTables;

use App\Application\Model\Events;
use Yajra\Datatables\Services\DataTable;

class EventssDataTable extends DataTable
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
              ->addColumn('id', 'admin.events.buttons.id')
             ->addColumn('edit', 'admin.events.buttons.edit')
             ->addColumn('delete', 'admin.events.buttons.delete')
             ->addColumn('view', 'admin.events.buttons.view')
             ->addColumn('user', 'admin.events.buttons.user')
             /*->addColumn('name', 'admin.events.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Events::query();

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

		if(request()->has("is_free") && request()->get("is_free") != ""){
				$query = $query->where("is_free","=", request()->get("is_free"));
		}

		if(request()->has("price_egp") && request()->get("price_egp") != ""){
				$query = $query->where("price_egp","=", request()->get("price_egp"));
		}

		if(request()->has("price_usd") && request()->get("price_usd") != ""){
				$query = $query->where("price_usd","=", request()->get("price_usd"));
		}

		if(request()->has("type") && request()->get("type") != ""){
				$query = $query->where("type","=", request()->get("type"));
		}

		if(request()->has("status") && request()->get("status") != ""){
				$query = $query->where("status","=", request()->get("status"));
		}

		if(request()->has("location") && request()->get("location") != ""){
				$query = $query->where("location","=", request()->get("location"));
		}

		if(request()->has("live_link") && request()->get("live_link") != ""){
				$query = $query->where("live_link","=", request()->get("live_link"));
		}

		if(request()->has("recorded_link") && request()->get("recorded_link") != ""){
				$query = $query->where("recorded_link","=", request()->get("recorded_link"));
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
                'title' => trans("events.title"),
                // 'render' => 'function(){
                //         return JSON.parse(this.title).'.getCurrentLang().';
                //     }',
                ],
               
			[
                'name' => 'user_id',
                'data' => 'user',
                'title' => 'user',
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
        return 'Eventsdatatables_' . time();
    }
}