<?php

namespace App\Application\DataTables;

use App\Application\Model\Transactions;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class TransactionssDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {

        // $transactions_users_courses = Transactions::join('users', 'transactions.user_id' , '=', 'users.id')
        // ->join('courses', 'transactions.courses_id', '=', 'courses.id')
        // ->select(['transactions.id', 'transactions.price', 'transactions.currency', 'transactions.percent', 'transactions.amount', 'transactions.type', 'transactions.created_at', 'users.first_name', 'users.last_name', 'courses.title'])
        // ->get();

        // return Datatables::of($transactions_users_courses)
        // ->addColumn('view', 'admin.courseenrollment.buttons.view')
        // ->addColumn('edit', 'admin.courseenrollment.buttons.edit')
        // ->addColumn('delete', 'admin.courseenrollment.buttons.delete')
        // ->make(true);

        return $this->datatables
             ->eloquent($this->query())
              ->addColumn('id', 'admin.transactions.buttons.id')
             ->addColumn('edit', 'admin.transactions.buttons.edit')
             ->addColumn('delete', 'admin.transactions.buttons.delete')
             ->addColumn('view', 'admin.transactions.buttons.view')
             ->addColumn('instructor' , 'admin.transactions.buttons.instructor')
             ->addColumn('course' , 'admin.transactions.buttons.course')
             /*->addColumn('name', 'admin.transactions.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        // $query = Transactions::join('users', 'transactions.user_id' , '=', 'users.id')
        // ->join('courses', 'transactions.courses_id', '=', 'courses.id')
        // ->select(['transactions.id', 'transactions.price', 'transactions.currency', 'transactions.percent', 'transactions.amount', 'transactions.type', 'transactions.created_at', 'users.first_name', 'users.last_name', 'courses.title']);

        $query = Transactions::query()->where('amount', '>', 0)->orderBy('created_at', 'DESC');

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

        if(request()->has('user_id') && request()->get('user_id') != ''){
            $query = $query->where("user_id","=", request()->get("user_id"));
        }

        if(request()->has('courses_id') && request()->get('courses_id') != ''){
            $query = $query->where("courses_id","=", request()->get("courses_id"));
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
                'name' => 'price',
                'data' => 'price',
                'title' => "Price",
                
            ],
            [
                'name' => 'currency',
                'data' => 'currency',
                'title' => "Currency",
                
            ],
            [
                'name' => 'percent',
                'data' => 'percent',
                'title' => "Commission Percentage",
                
            ],
            [
                'name' => 'amount',
                'data' => 'amount',
                'title' => "Instructor's cut",
                
            ],
            [
                'name' => 'type',
                'data' => 'type',
                'title' => "Commission Type",
                
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => "Create Date",
                
            ],

            [
                'name' => 'instructor',
                'data' => 'instructor',
                'title' => "Instructor",
            ],
            [
                'name' => 'course',
                'data' => 'course',
                'title' => "Course",
                
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
        return 'Transactionsdatatables_' . time();
    }
}