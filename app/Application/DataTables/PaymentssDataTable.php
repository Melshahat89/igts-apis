<?php

namespace App\Application\DataTables;

use App\Application\Model\Payments;
use Yajra\Datatables\Services\DataTable;

class PaymentssDataTable extends DataTable
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
            ->addColumn('id', 'admin.payments.buttons.id')
            ->addColumn('edit', 'admin.payments.buttons.edit')
            ->addColumn('delete', 'admin.payments.buttons.delete')
            ->addColumn('view', 'admin.payments.buttons.view')
            /*->addColumn('name', 'admin.payments.buttons.langcol')*/
            ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Payments::query();

        if (request()->has('from') && request()->get('from') != '') {
            $query = $query->whereDate('created_at', '>=', request()->get('from'));
        }

        if (request()->has('to') && request()->get('to') != '') {
            $query = $query->whereDate('created_at', '<=', request()->get('to'));
        }

        if (request()->has("operation") && request()->get("operation") != "") {
            $query = $query->where("operation", "=", request()->get("operation"));
        }

        if (request()->has("amount") && request()->get("amount") != "") {
            $query = $query->where("amount", "=", request()->get("amount"));
        }

        if (request()->has("currency_id") && request()->get("currency_id") != "") {
            $query = $query->where("currency_id", "=", request()->get("currency_id"));
        }

        if (request()->has("receiver_id") && request()->get("receiver_id") != "") {
            $query = $query->where("receiver_id", "=", request()->get("receiver_id"));
        }

        if (request()->has("token") && request()->get("token") != "") {
            $query = $query->where("token", "=", request()->get("token"));
        }

        if (request()->has("token_date") && request()->get("token_date") != "") {
            $query = $query->where("token_date", "=", request()->get("token_date"));
        }

        if (request()->has("status") && request()->get("status") != "") {
            $query = $query->where("status", "=", request()->get("status"));
        }

        if (request()->has("accept_source_data_type") && request()->get("accept_source_data_type") != "") {
            $query = $query->where("accept_source_data_type", "=", request()->get("accept_source_data_type"));
        }

        if (request()->has("accept_id") && request()->get("accept_id") != "") {
            $query = $query->where("accept_id", "=", request()->get("accept_id"));
        }

        if (request()->has("accept_pending") && request()->get("accept_pending") != "") {
            $query = $query->where("accept_pending", "=", request()->get("accept_pending"));
        }

        if (request()->has("accept_order") && request()->get("accept_order") != "") {
            $query = $query->where("accept_order", "=", request()->get("accept_order"));
        }

        if (request()->has("accept_amount_cents") && request()->get("accept_amount_cents") != "") {
            $query = $query->where("accept_amount_cents", "=", request()->get("accept_amount_cents"));
        }

        if (request()->has("accept_success") && request()->get("accept_success") != "") {
            $query = $query->where("accept_success", "=", request()->get("accept_success"));
        }

        if (request()->has("accept_data_message") && request()->get("accept_data_message") != "") {
            $query = $query->where("accept_data_message", "=", request()->get("accept_data_message"));
        }

        if (request()->has("accept_profile_id") && request()->get("accept_profile_id") != "") {
            $query = $query->where("accept_profile_id", "=", request()->get("accept_profile_id"));
        }

        if (request()->has("accept_source_data_sub_type") && request()->get("accept_source_data_sub_type") != "") {
            $query = $query->where("accept_source_data_sub_type", "=", request()->get("accept_source_data_sub_type"));
        }

        if (request()->has("accept_hmac") && request()->get("accept_hmac") != "") {
            $query = $query->where("accept_hmac", "=", request()->get("accept_hmac"));
        }

        if (request()->has("txn_response_code") && request()->get("txn_response_code") != "") {
            $query = $query->where("txn_response_code", "=", request()->get("txn_response_code"));
        }


        $query = $query->orderBy('id', 'desc');
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
                'name' => 'amount',
                'data' => 'amount',
                'title' => "amount",

            ],
            [
                'name' => 'status',
                'data' => 'status',
                'title' => "status",

            ],
            [
                'name' => 'accept_id',
                'data' => 'accept_id',
                'title' => "accept_id",

            ],
            [
                'name' => 'accept_data_message',
                'data' => 'accept_data_message',
                'title' => "accept_data_message",

            ],
            [
                'name' => 'accept_success',
                'data' => 'accept_success',
                'title' => "accept_success",

            ],
            [
                'name' => 'txn_response_code',
                'data' => 'txn_response_code',
                'title' => "txn_response_code",

            ],
            [
                'name' => 'accept_hmac',
                'data' => 'accept_hmac',
                'title' => "accept_hmac",

            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => "created_at",

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
        return 'Paymentsdatatables_' . time();
    }
}
