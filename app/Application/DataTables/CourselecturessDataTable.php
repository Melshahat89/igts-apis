<?php

namespace App\Application\DataTables;

use App\Application\Model\Courselectures;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Services\DataTable;

class CourselecturessDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {


        $lectures_courses = Courselectures::join('courses', 'courselectures.courses_id' , '=', 'courses.id')
        ->select(['courselectures.id', 'courselectures.title as lecturetitle', 'courses.title'])
        ->get();

        return Datatables::of($lectures_courses)
        ->addColumn('view', 'admin.courselectures.buttons.view')
        ->addColumn('edit', 'admin.courselectures.buttons.edit')
        ->addColumn('delete', 'admin.courselectures.buttons.delete')
        ->make(true);

        // return $this->datatables
        //      ->eloquent($this->query())
        //       ->addColumn('id', 'admin.courselectures.buttons.id')
        //      ->addColumn('edit', 'admin.courselectures.buttons.edit')
        //      ->addColumn('delete', 'admin.courselectures.buttons.delete')
        //      ->addColumn('view', 'admin.courselectures.buttons.view')
        //      ->addColumn('course', 'admin.courselectures.buttons.course')
        //      /*->addColumn('name', 'admin.courselectures.buttons.langcol')*/
        //      ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Courselectures::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("title") && request()->get("title") != ""){
				$query = $query->where("title","like", "%".request()->get("title")."%");
		}

		if(request()->has("slug") && request()->get("slug") != ""){
				$query = $query->where("slug","=", request()->get("slug"));
		}

		if(request()->has("description") && request()->get("description") != ""){
				$query = $query->where("description","like", "%".request()->get("description")."%");
		}

		if(request()->has("video_file") && request()->get("video_file") != ""){
				$query = $query->where("video_file","=", request()->get("video_file"));
		}

		// if(request()->has("length") && request()->get("length") != ""){
		// 		$query = $query->where("length","=", request()->get("length"));
		// }

		if(request()->has("is_free") && request()->get("is_free") != ""){
				$query = $query->where("is_free","=", request()->get("is_free"));
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
                'name' => 'title',
                'data' => 'lecturetitle',
                'title' => trans("courselectures.title"),
                // 'render' => 'function(){
                //         return JSON.parse(this.title).'.getCurrentLang().';
                //     }',
                ],
			[
                'name' => 'title',
                'data' => 'title',
                'title' => trans("courses.courses"),
                'render' => 'function(){
                        return JSON.parse(this.title).'.getCurrentLang().';
                    }',
                
                ],
			// [
            //     'name' => 'length',
            //     'data' => 'length',
            //     'title' => trans("courselectures.length"),
                
            //     ],
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
        return 'Courselecturesdatatables_' . time();
    }
}