<?php

namespace App\Application\DataTables;

use App\Application\Model\Promotions;
use Yajra\Datatables\Services\DataTable;

class PromotionssDataTable extends DataTable
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
              ->addColumn('id', 'admin.promotions.buttons.id')
              ->addColumn('promo_id', 'admin.promotions.buttons.payment')
              ->addColumn('promo_id2', 'admin.promotions.buttons.courses')
             ->addColumn('edit', 'admin.promotions.buttons.edit')
             ->addColumn('delete', 'admin.promotions.buttons.delete')
             ->addColumn('view', 'admin.promotions.buttons.view')
             /*->addColumn('name', 'admin.promotions.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Promotions::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("title") && request()->get("title") != ""){
				$query = $query->where("title","=", request()->get("title"));
		}

		if(request()->has("description") && request()->get("description") != ""){
				$query = $query->where("description","=", request()->get("description"));
		}

		if(request()->has("type") && request()->get("type") != ""){
				$query = $query->where("type","=", request()->get("type"));
		}

		if(request()->has("value_for_egp") && request()->get("value_for_egp") != ""){
				$query = $query->where("value_for_egp","=", request()->get("value_for_egp"));
		}

		if(request()->has("value_for_other_currencies") && request()->get("value_for_other_currencies") != ""){
				$query = $query->where("value_for_other_currencies","=", request()->get("value_for_other_currencies"));
		}

		if(request()->has("code") && request()->get("code") != ""){
				$query = $query->where("code","=", request()->get("code"));
		}

		if(request()->has("start_date") && request()->get("start_date") != ""){
				$query = $query->where("start_date","=", request()->get("start_date"));
		}

		if(request()->has("expiration_date") && request()->get("expiration_date") != ""){
				$query = $query->where("expiration_date","=", request()->get("expiration_date"));
		}

		if(request()->has("active") && request()->get("active") != ""){
				$query = $query->where("active","=", request()->get("active"));
		}

		if(request()->has("promotion_limit") && request()->get("promotion_limit") != ""){
				$query = $query->where("promotion_limit","=", request()->get("promotion_limit"));
		}

		if(request()->has("promotion_usage") && request()->get("promotion_usage") != ""){
				$query = $query->where("promotion_usage","=", request()->get("promotion_usage"));
		}

		if(request()->has("publish_as_notification") && request()->get("publish_as_notification") != ""){
				$query = $query->where("publish_as_notification","=", request()->get("publish_as_notification"));
		}

		if(request()->has("notification_message") && request()->get("notification_message") != ""){
				$query = $query->where("notification_message","=", request()->get("notification_message"));
		}

		if(request()->has("include_courses") && request()->get("include_courses") != ""){
				$query = $query->where("include_courses","=", request()->get("include_courses"));
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
                'name' => "id",
                'data' => 'promo_id',
                'title' => 'Amount',
           ],

           [
            'name' => "id",
            'data' => 'promo_id2',
            'title' => 'Number of Courses',
       ],


			[
                'name' => 'title',
                'data' => 'title',
                'title' => "title",
                
                ],

            [
                'name' => 'type',
                'data' => 'type',
                'title' => "Type",
                
                ],

            [
                'name' => 'value_for_egp',
                'data' => 'value_for_egp',
                'title' => "EGP Discount",
                
                ],

            [
                'name' => 'value_for_other_currencies',
                'data' => 'value_for_other_currencies',
                'title' => "USD Discount",
                
                ],

            [
                'name' => 'code',
                'data' => 'code',
                'title' => "Code",
                
                ],

                [
                    'name' => 'promotion_usage',
                    'data' => 'promotion_usage',
                    'title' => "Usage",
                    
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
        return 'Promotionsdatatables_' . time();
    }
}