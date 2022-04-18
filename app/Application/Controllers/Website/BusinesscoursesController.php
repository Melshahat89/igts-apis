<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Businesscourses;
use App\Application\Requests\Website\Businesscourses\AddRequestBusinesscourses;
use App\Application\Requests\Website\Businesscourses\UpdateRequestBusinesscourses;

class BusinesscoursesController extends AbstractController
{

     public function __construct(Businesscourses $model)
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

			if(request()->has("comment") && request()->get("comment") != ""){
				$items = $items->where("comment","=", request()->get("comment"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.businesscourses.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.businesscourses.edit' , $id);
     }

     public function store(AddRequestBusinesscourses $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('businesscourses');
     }

     public function update($id , UpdateRequestBusinesscourses $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.businesscourses.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'businesscourses')->with('sucess' , 'Done Delete Businesscourses From system');
     }


}
