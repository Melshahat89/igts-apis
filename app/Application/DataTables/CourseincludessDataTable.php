<?php

namespace App\Application\DataTables;

use App\Application\Model\Courseincludes;
use Yajra\Datatables\Services\DataTable;

class CourseincludessDataTable extends DataTable
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
              ->addColumn('id', 'admin.courseincludes.buttons.id')
              ->addColumn('courses_id', 'admin.courseincludes.buttons.courses')
              ->addColumn('included_course', 'admin.courseincludes.buttons.includedCourse')
             ->addColumn('edit', 'admin.courseincludes.buttons.edit')
             ->addColumn('delete', 'admin.courseincludes.buttons.delete')
             ->addColumn('view', 'admin.courseincludes.buttons.view')
             /*->addColumn('name', 'admin.courseincludes.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Courseincludes::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("position") && request()->get("position") != ""){
				$query = $query->where("position","=", request()->get("position"));
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
                'name' => 'courses_id',
                'data' => 'courses_id',
                'title' => 'Course',

             ],
             [
                'name' => 'included_course',
                'data' => 'included_course',
                'title' => 'Included Course',

             ],
			[
                'name' => 'position',
                'data' => 'position',
                'title' => "position",
                
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
        return 'Courseincludesdatatables_' . time();
    }
}