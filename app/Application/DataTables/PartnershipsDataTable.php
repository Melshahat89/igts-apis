<?php

namespace App\Application\DataTables;

use App\Application\Model\Partnership;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class PartnershipsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {

        $partnership_users = Partnership::join('users', 'partnership.user_id' , '=', 'users.id')
        ->select(['partnership.id', 'users.first_name', 'users.last_name', 'users.email'])
        ->get();

        
        return Datatables::of($partnership_users)
        ->addColumn('view', 'admin.partnership.buttons.view')
        ->addColumn('edit', 'admin.partnership.buttons.edit')
        ->addColumn('delete', 'admin.partnership.buttons.delete')
        ->make(true);

        // return $this->datatables
        //      ->eloquent($this->query())
        //       ->addColumn('id', 'admin.partnership.buttons.id')
        //      ->addColumn('edit', 'admin.partnership.buttons.edit')
        //      ->addColumn('delete', 'admin.partnership.buttons.delete')
        //      ->addColumn('view', 'admin.partnership.buttons.view')
        //      /*->addColumn('name', 'admin.partnership.buttons.langcol')*/
        //      ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Partnership::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("setting") && request()->get("setting") != ""){
				$query = $query->where("setting","=", request()->get("setting"));
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
                'name' => 'first_name',
                'data' => 'first_name',
                'title' => "First Name",
                
                ],
                [
                    'name' => 'last_name',
                    'data' => 'last_name',
                    'title' => "Last Name",
                    
                    ],
                    [
                        'name' => 'email',
                        'data' => 'email',
                        'title' => "Email",
                        
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
        return 'Partnershipdatatables_' . time();
    }
}