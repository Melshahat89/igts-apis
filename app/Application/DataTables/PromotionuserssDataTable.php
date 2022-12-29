<?php

namespace App\Application\DataTables;

use App\Application\Model\Promotionusers;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class PromotionuserssDataTable extends DataTable
{
    /**
     * Display ajax response.
     *f
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {

        $promotions_promousers_users_orders = Promotionusers::join('promotions', 'promotionusers.promotions_id' , '=', 'promotions.id')
        ->join('users', 'promotionusers.user_id', '=', 'users.id')
        // ->join('orders', 'promotionusers.orders_id', '=', 'orders.id')
        // ->join('payments', 'orders.payments_id', '=', 'payments.id')
        ->select(['promotions.id', 'promotions.code', 'promotionusers.used', 'users.email'])
        ->get();

        return Datatables::of($promotions_promousers_users_orders)
        ->addColumn('view', 'admin.promotionusers.buttons.view')
        ->addColumn('edit', 'admin.promotionusers.buttons.edit')
        ->addColumn('delete', 'admin.promotionusers.buttons.delete')
        ->make(true);

        // return $this->datatables
        //      ->eloquent($this->query())
        //       ->addColumn('id', 'admin.promotionusers.buttons.id')
        //      ->addColumn('edit', 'admin.promotionusers.buttons.edit')
        //      ->addColumn('delete', 'admin.promotionusers.buttons.delete')
        //      ->addColumn('view', 'admin.promotionusers.buttons.view')
        //      /*->addColumn('name', 'admin.promotionusers.buttons.langcol')*/
        //      ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Promotionusers::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("used") && request()->get("used") != ""){
				$query = $query->where("used","=", request()->get("used"));
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
                  'title' => "Promotion ID",
             ],
             [
                'name' => 'code',
                'data' => 'code',
                'title' => "Promotion",
                
                ],
			[
                'name' => 'used',
                'data' => 'used',
                'title' => "used",
                
                ],
            [
                'name' => 'users.email',
                'data' => 'email',
                'title' => "User Email",
                
                ],

            //     [
            //         'name' => 'payments.amount',
            //         'data' => 'amount',
            //         'title' => "Amount",
                    
            //         ],
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
        return 'Promotionusersdatatables_' . time();
    }
}