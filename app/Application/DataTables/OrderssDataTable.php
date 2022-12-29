<?php

namespace App\Application\DataTables;

use App\Application\Model\Orders;
use App\Application\Model\User;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Services\DataTable;

class OrderssDataTable extends DataTable
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
            ->addColumn('id', 'admin.orders.buttons.id')
            ->addColumn('edit', 'admin.orders.buttons.edit')
            ->addColumn('delete', 'admin.orders.buttons.delete')
            ->addColumn('view', 'admin.orders.buttons.view')
            ->addColumn('stat', 'admin.orders.buttons.stat')
            ->addColumn('payment', 'admin.orders.buttons.payment')
            ->addColumn('user', 'admin.orders.buttons.user')
            ->addColumn('phone', 'admin.orders.buttons.phone')
            ->addColumn('type', 'admin.orders.buttons.type')
            ->addColumn('sub', 'admin.orders.buttons.sub')
            ->addColumn('courses', 'admin.orders.buttons.courses')
            ->addColumn('amount', 'admin.orders.buttons.amount')
            ->addColumn('orderType', 'admin.orders.buttons.orderType')
            ->addColumn('employee', 'admin.orders.buttons.employee')
            ->addColumn('approve', 'admin.orders.buttons.approve')
            ->addColumn('copy', 'admin.orders.buttons.copyurl')

            ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Orders::query()->orderBy('updated_at', 'DESC');

        if(Auth::user()->group_id == User::TYPE_ADMIN || Auth::user()->group_id == User::TYPE_ACCOUNTANT || Auth::user()->group_id == User::TYPE_SALES_MANAGER || Auth::user()->group_id == User::TYPE_MARKETING){

        }else{
            $query = $query->where('emp_id', Auth::user()->id);
        }
        if (request()->has('from') && request()->get('from') != '') {
            $query = $query->whereDate('updated_at', '>=', request()->get('from'));
        }

        if (request()->has('to') && request()->get('to') != '') {
            $query = $query->whereDate('updated_at', '<=', request()->get('to'));
        }

        if (request()->has("status") && request()->get("status") != "") {
            $query = $query->where("status", "=", request()->get("status"));
        }
        
          if (request()->has("email") && request()->get("email") != "") {
            $query = $query->whereHas('user', function($q){
                $q->where('email', 'LIKE', '%' . request()->get("email") . '%' );
            });
        }

        if (request()->has("employee") && request()->get("employee") != "") {
            $query = $query->where('emp_id', request()->get("employee"));
        }


        if (request()->has("course_name") && request()->get("course_name") != "") {
            $query = $query->where(function ($query) {
                $query->where('status', 1)
                      ->orWhere('status', 2)
                    
                      ;
            })->whereHas('ordersposition', function($q){
                $q->whereHas('courses', function($q2){
                    $q2->where('title', 'LIKE', '%' . request()->get("course_name") . '%' );
                });
            });
        }

        if (request()->has("payment_type") && request()->get("payment_type") != "") {
            $query = $query->whereHas('payments', function($q){
                $q->where('accept_source_data_type', 'LIKE', '%' . request()->get("payment_type") . '%' );
            });
        }


        if (request()->has("payment_sub_type") && request()->get("payment_sub_type") != "") {
            $query = $query->whereHas('payments', function($q){
                $q->where('accept_source_data_sub_type', 'LIKE', '%' . request()->get("payment_sub_type") . '%' );
            });
        }

        if (request()->has("billing_address_id") && request()->get("billing_address_id") != "") {
            $query = $query->where("billing_address_id", "=", request()->get("billing_address_id"));
        }

        if (request()->has("accept_order_id") && request()->get("accept_order_id") != "") {
            $query = $query->where("accept_order_id", "=", request()->get("accept_order_id"));
        }

        if (request()->has("kiosk_id") && request()->get("kiosk_id") != "") {
            $query = $query->where("kiosk_id", "=", request()->get("kiosk_id"));
        }

        if(request()->has('orderType') && request()->get('orderType') != ""){
            $query = $query->where("type", "=", request()->get("orderType"));

        }


        // $query = $query->orderBy('id', 'desc');
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
        $columns = [];

        array_push($columns,
            [
                'name' => "id",
                'data' => 'id',
                'title' => trans('curd.id'),
            ],

            [
                'name' => 'user_id',
                'data' => 'user',
                'title' => "user",

            ],
            [
                'name' => 'user_id',
                'data' => 'phone',
                'title' => 'Phone',
            
            ],
            [
                'name' => 'emp_id',
                'data' => 'employee',
                'title' => "Employee",

            ],
            [
                'name' => 'status',
                'data' => 'stat',
                'title' => "status",

            ],
            [
                'name' => 'type',
                'data' => 'orderType',
                'title' => "Type",

            ],
            [
                'name' => 'payments_id',
                'data' => 'payment',
                'title' => "payment",

            ],
            [
                'name' => 'payments_id',
                'data' => 'amount',
                'title' => 'amount',

            ],

            [
                'name' => 'copy',
                'data' => 'copy',
                'title' => 'DIRECTPAY URL',
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false,
            ],
            [
                'name' => 'status',
                'data' => 'type',
                'title' => "Payment type",

            ],
            [
                'name' => 'status',
                'data' => 'courses',
                'title' => "courses",

            ]
           
        );

        if(Auth::user()->group_id == User::TYPE_ADMIN || Auth::user()->group_id == User::TYPE_ACCOUNTANT || Auth::user()->group_id == User::TYPE_SALES_MANAGER){
            
            array_push($columns, 
                [
                    'name' => 'status',
                    'data' => 'sub',
                    'title' => "Payment sub type",
    
                ],
                [
                    'name' => 'accept_order_id',
                    'data' => 'accept_order_id',
                    'title' => "Accept",
    
                ],
                [
                    'name' => 'kiosk_id',
                    'data' => 'kiosk_id',
                    'title' => "Kiosk",
    
                ],
                [
                    'name' => 'fawryRefNumber',
                    'data' => 'fawryRefNumber',
                    'title' => "Fawry",
    
                ]
            );
        }

        if(Auth::user()->group_id == User::TYPE_ADMIN || Auth::user()->group_id == User::TYPE_ACCOUNTANT || Auth::user()->group_id == User::TYPE_SALES_MANAGER){
            array_push($columns, 
                [
                    'name' => 'approve',
                    'data' => 'approve',
                    'title' => 'Approve',
                    'exportable' => false,
                    'printable' => false,
                    'searchable' => false,
                    'orderable' => false
                ]
                );
        }

        array_push($columns, 

            [
                'name' => 'updated_at',
                'data' => 'updated_at',
                'title' => 'updated_at',

            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('user.created_at'),

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
                'title' => trans('curd.edit'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('curd.delete'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false
            ]
        );
        
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ordersdatatables_' . time();
    }
}
