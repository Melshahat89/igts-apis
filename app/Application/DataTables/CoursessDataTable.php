<?php

namespace App\Application\DataTables;

use App\Application\Model\Courses;
use Yajra\Datatables\Services\DataTable;

class CoursessDataTable extends DataTable
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
              ->addColumn('id', 'admin.courses.buttons.id')
              ->addColumn('instructor_id', 'admin.courses.buttons.instructor')
              ->addColumn('quiz', 'admin.courses.buttons.quiz')
              ->addColumn('resources', 'admin.courses.buttons.resources')
             ->addColumn('edit', 'admin.courses.buttons.edit')
             ->addColumn('delete', 'admin.courses.buttons.delete')
             ->addColumn('view', 'admin.courses.buttons.view')
             /*->addColumn('name', 'admin.courses.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Courses::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

        if(request()->has('instructor_id') && request()->get('instructor_id') != ''){
            $query = $query->where("instructor_id","=", request()->get("instructor_id"));
        }
        

		if(request()->has("language_id") && request()->get("language_id") != ""){
				$query = $query->where("language_id","=", request()->get("language_id"));
		}

        if(request()->has("type") && request()->get("type") != ""){
            $query = $query->where("type","=", request()->get("type"));
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
                'title' => trans("courses.courses"),
                // 'render' => 'function(){
                //         return JSON.parse(this.title).'.getCurrentLang().';
                //     }',
                ],

                [
                    'name' => 'instructor_id',
                    'data' => 'instructor_id',
                    'title' => 'Instructor'
                ],
                [
                    'name' => 'id',
                    'data' => 'quiz',
                    'title' => 'Quiz',

                ],
                [
                    'name' => 'id',
                    'data' => 'resources',
                    'title' => 'Resources',

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
        return 'Coursesdatatables_' . time();
    }
}