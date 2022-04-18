<?php

namespace App\Application\DataTables;

use App\Application\Model\Masterrequest;
use Yajra\Datatables\Services\DataTable;

class MasterrequestsDataTable extends DataTable
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
              ->addColumn('id', 'admin.masterrequest.buttons.id')
             ->addColumn('edit', 'admin.masterrequest.buttons.edit')
             ->addColumn('delete', 'admin.masterrequest.buttons.delete')
             ->addColumn('view', 'admin.masterrequest.buttons.view')
             /*->addColumn('name', 'admin.masterrequest.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Masterrequest::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("collage_name") && request()->get("collage_name") != ""){
				$query = $query->where("collage_name","=", request()->get("collage_name"));
		}

		if(request()->has("section") && request()->get("section") != ""){
				$query = $query->where("section","=", request()->get("section"));
		}

		if(request()->has("g_year") && request()->get("g_year") != ""){
				$query = $query->where("g_year","=", request()->get("g_year"));
		}

		if(request()->has("address") && request()->get("address") != ""){
				$query = $query->where("address","=", request()->get("address"));
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
                'name' => 'qualification',
                'data' => 'qualification',
                'title' => "qualification",
                'render' => 'function( ){
                                       return \'<img src="http://localhost/meduo/public/uploads/files/small/\'+JSON.parse(this.qualification)+\'" /> \';
                                    }',
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
        return 'Masterrequestdatatables_' . time();
    }
}