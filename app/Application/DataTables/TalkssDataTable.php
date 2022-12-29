<?php

namespace App\Application\DataTables;

use App\Application\Model\Talks;
use Yajra\Datatables\Services\DataTable;

class TalkssDataTable extends DataTable
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
              ->addColumn('id', 'admin.talks.buttons.id')
             ->addColumn('edit', 'admin.talks.buttons.edit')
             ->addColumn('delete', 'admin.talks.buttons.delete')
             ->addColumn('view', 'admin.talks.buttons.view')
             ->addColumn('like', 'admin.talks.buttons.like')
             ->addColumn('dislike', 'admin.talks.buttons.dislike')
             /*->addColumn('name', 'admin.talks.buttons.langcol')*/
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Talks::query();

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

		if(request()->has("subtitle") && request()->get("subtitle") != ""){
				$query = $query->where("subtitle","like", "%".request()->get("subtitle")."%");
		}

		if(request()->has("description") && request()->get("description") != ""){
				$query = $query->where("description","like", "%".request()->get("description")."%");
		}

		if(request()->has("language_id") && request()->get("language_id") != ""){
				$query = $query->where("language_id","=", request()->get("language_id"));
		}

		// if(request()->has("length") && request()->get("length") != ""){
		// 		$query = $query->where("length","=", request()->get("length"));
		// }

		if(request()->has("featured") && request()->get("featured") != ""){
				$query = $query->where("featured","=", request()->get("featured"));
		}

		if(request()->has("published") && request()->get("published") != ""){
				$query = $query->where("published","=", request()->get("published"));
		}

		if(request()->has("visits") && request()->get("visits") != ""){
				$query = $query->where("visits","=", request()->get("visits"));
		}

		if(request()->has("video_file") && request()->get("video_file") != ""){
				$query = $query->where("video_file","=", request()->get("video_file"));
		}

		if(request()->has("sort") && request()->get("sort") != ""){
				$query = $query->where("sort","=", request()->get("sort"));
		}

		if(request()->has("doctor_name") && request()->get("doctor_name") != ""){
				$query = $query->where("doctor_name","like", "%".request()->get("doctor_name")."%");
		}

		if(request()->has("seo_desc") && request()->get("seo_desc") != ""){
				$query = $query->where("seo_desc","like", "%".request()->get("seo_desc")."%");
		}

		if(request()->has("seo_keys") && request()->get("seo_keys") != ""){
				$query = $query->where("seo_keys","like", "%".request()->get("seo_keys")."%");
		}

		if(request()->has("search_keys") && request()->get("search_keys") != ""){
				$query = $query->where("search_keys","like", "%".request()->get("search_keys")."%");
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
                'title' => trans("talks.title"),
                // 'render' => 'function(){
                //         return JSON.parse(this.title).'.getCurrentLang().';
                //     }',
                ],
                [
                    'name' => "id",
                    'data' => 'like',
                    'title' => 'Likes',
               ],
               [
                'name' => "id",
                'data' => 'dislike',
                'title' => 'Dislikes',
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
        return 'Talksdatatables_' . time();
    }
}