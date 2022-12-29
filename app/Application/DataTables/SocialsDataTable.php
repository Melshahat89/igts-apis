<?php

namespace App\Application\DataTables;

use App\Application\Model\Social;
use Yajra\Datatables\Services\DataTable;

class SocialsDataTable extends DataTable
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
              ->addColumn('id', 'admin.social.buttons.id')
             ->addColumn('edit', 'admin.social.buttons.edit')
             ->addColumn('delete', 'admin.social.buttons.delete')
             ->addColumn('view', 'admin.social.buttons.view')
             /*->addColumn('name', 'admin.social.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Social::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("user_id") && request()->get("user_id") != ""){
				$query = $query->where("user_id","=", request()->get("user_id"));
		}

		if(request()->has("provider") && request()->get("provider") != ""){
				$query = $query->where("provider","=", request()->get("provider"));
		}

		if(request()->has("identifier") && request()->get("identifier") != ""){
				$query = $query->where("identifier","=", request()->get("identifier"));
		}

		if(request()->has("profile_cache") && request()->get("profile_cache") != ""){
				$query = $query->where("profile_cache","=", request()->get("profile_cache"));
		}

		if(request()->has("session_data") && request()->get("session_data") != ""){
				$query = $query->where("session_data","=", request()->get("session_data"));
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
                'name' => 'user_id',
                'data' => 'user_id',
                'title' => "user_id",
                
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
        return 'Socialdatatables_' . time();
    }
}