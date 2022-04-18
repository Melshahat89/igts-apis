<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Courseincludes;
use App\Application\Requests\Website\Courseincludes\AddRequestCourseincludes;
use App\Application\Requests\Website\Courseincludes\UpdateRequestCourseincludes;

class CourseincludesController extends AbstractController
{

     public function __construct(Courseincludes $model)
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

			if(request()->has("position") && request()->get("position") != ""){
				$items = $items->where("position","=", request()->get("position"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.courseincludes.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.courseincludes.edit' , $id);
     }

     public function store(AddRequestCourseincludes $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('courseincludes');
     }

     public function update($id , UpdateRequestCourseincludes $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.courseincludes.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'courseincludes')->with('sucess' , 'Done Delete Courseincludes From system');
     }


}
