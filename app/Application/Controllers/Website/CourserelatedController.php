<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Courserelated;
use App\Application\Requests\Website\Courserelated\AddRequestCourserelated;
use App\Application\Requests\Website\Courserelated\UpdateRequestCourserelated;

class CourserelatedController extends AbstractController
{

     public function __construct(Courserelated $model)
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
        return view('website.courserelated.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.courserelated.edit' , $id);
     }

     public function store(AddRequestCourserelated $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('courserelated');
     }

     public function update($id , UpdateRequestCourserelated $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.courserelated.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'courserelated')->with('sucess' , 'Done Delete Courserelated From system');
     }


}
