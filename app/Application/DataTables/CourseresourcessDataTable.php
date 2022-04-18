<?php

namespace App\Application\DataTables;

use App\Application\Model\Courseresources;
use Yajra\Datatables\Services\DataTable;

class CourseresourcessDataTable extends DataTable
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
              ->addColumn('id', 'admin.courseresources.buttons.id')
              ->addColumn('courses_id', 'admin.courseresources.buttons.course')
              ->addColumn('instructor', 'admin.courseresources.buttons.instructor')
             ->addColumn('edit', 'admin.courseresources.buttons.edit')
             ->addColumn('delete', 'admin.courseresources.buttons.delete')
             ->addColumn('view', 'admin.courseresources.buttons.view')
             /*->addColumn('name', 'admin.courseresources.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Courseresources::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

        if(request()->has("course") && request()->get("course") != ""){
            $query = $query->where("courses_id","=", request()->get("course"));
    }



		if(request()->has("title") && request()->get("title") != ""){
				$query = $query->where("title","like", "%".request()->get("title")."%");
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
                'title' => trans("courseresources.title"),
                'render' => 'function(){
                        return JSON.parse(this.title).'.getCurrentLang().';
                    }',
                ],

                [
                    'name' => 'courses_id',
                    'data' => 'courses_id',
                    'title' => "Course",
                    
                    ],

                    [
                        'name' => 'courses_id',
                        'data' => 'instructor',
                        'title' => "Instructor",
                        
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
        return 'Courseresourcesdatatables_' . time();
    }
}