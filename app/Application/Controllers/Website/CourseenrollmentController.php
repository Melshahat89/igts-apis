<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Courseenrollment;
use App\Application\Requests\Website\Courseenrollment\AddRequestCourseenrollment;
use App\Application\Requests\Website\Courseenrollment\UpdateRequestCourseenrollment;

class CourseenrollmentController extends AbstractController
{

     public function __construct(Courseenrollment $model)
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

			if(request()->has("start_time") && request()->get("start_time") != ""){
				$items = $items->where("start_time","=", request()->get("start_time"));
			}

			if(request()->has("end_time") && request()->get("end_time") != ""){
				$items = $items->where("end_time","=", request()->get("end_time"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.courseenrollment.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.courseenrollment.edit' , $id);
     }

     public function store(AddRequestCourseenrollment $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('courseenrollment');
     }

     public function update($id , UpdateRequestCourseenrollment $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.courseenrollment.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'courseenrollment')->with('sucess' , 'Done Delete Courseenrollment From system');
     }


}
