<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Categories;
use App\Application\Requests\Website\Categories\AddRequestCategories;
use App\Application\Requests\Website\Categories\UpdateRequestCategories;

class CategoriesController extends AbstractController
{

     public function __construct(Categories $model)
     {
        parent::__construct($model);
     }

     public function index(){
        $items = $this->model;

        if(request()->has('from') && request()->get('from') != ''){
            $items = $items->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $items = $items->whereDate('created_at' , '<=' , request()->get('to'));
        }

			if(request()->has("name") && request()->get("name") != ""){
				$items = $items->where("name","like", "%".request()->get("name")."%");
			}

			if(request()->has("slug") && request()->get("slug") != ""){
				$items = $items->where("slug","=", request()->get("slug"));
			}

			if(request()->has("desc") && request()->get("desc") != ""){
				$items = $items->where("desc","like", "%".request()->get("desc")."%");
			}

			if(request()->has("parent_id") && request()->get("parent_id") != ""){
				$items = $items->where("parent_id","=", request()->get("parent_id"));
			}

			if(request()->has("sort") && request()->get("sort") != ""){
				$items = $items->where("sort","=", request()->get("sort"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}

			if(request()->has("show_home") && request()->get("show_home") != ""){
				$items = $items->where("show_home","=", request()->get("show_home"));
			}

			if(request()->has("show_menu") && request()->get("show_menu") != ""){
				$items = $items->where("show_menu","=", request()->get("show_menu"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.categories.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.categories.edit' , $id);
     }

     public function store(AddRequestCategories $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('categories');
     }

     public function update($id , UpdateRequestCategories $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.categories.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'categories')->with('sucess' , 'Done Delete Categories From system');
     }


}
