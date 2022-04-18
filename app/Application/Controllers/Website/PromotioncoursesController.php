<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Promotioncourses;
use App\Application\Requests\Website\Promotioncourses\AddRequestPromotioncourses;
use App\Application\Requests\Website\Promotioncourses\UpdateRequestPromotioncourses;

class PromotioncoursesController extends AbstractController
{

     public function __construct(Promotioncourses $model)
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

			if(request()->has("note") && request()->get("note") != ""){
				$items = $items->where("note","=", request()->get("note"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.promotioncourses.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.promotioncourses.edit' , $id);
     }

     public function store(AddRequestPromotioncourses $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('promotioncourses');
     }

     public function update($id , UpdateRequestPromotioncourses $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.promotioncourses.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'promotioncourses')->with('sucess' , 'Done Delete Promotioncourses From system');
     }


}
