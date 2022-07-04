<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\BecomeInstructor;
use App\Application\Requests\Website\BecomeInstructor\AddRequestBecomeInstructor;
use App\Application\Requests\Website\BecomeInstructor\UpdateRequestBecomeInstructor;

class BecomeInstructorController extends AbstractController
{

     public function __construct(BecomeInstructor $model)
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
				$items = $items->where("name","=", request()->get("name"));
			}

			if(request()->has("email") && request()->get("email") != ""){
				$items = $items->where("email","=", request()->get("email"));
			}

			if(request()->has("phone") && request()->get("phone") != ""){
				$items = $items->where("phone","=", request()->get("phone"));
			}

			if(request()->has("title") && request()->get("title") != ""){
				$items = $items->where("title","=", request()->get("title"));
			}

			if(request()->has("specialist") && request()->get("specialist") != ""){
				$items = $items->where("specialist","=", request()->get("specialist"));
			}

			if(request()->has("yourCourses") && request()->get("yourCourses") != ""){
				$items = $items->where("yourCourses","=", request()->get("yourCourses"));
			}

			if(request()->has("socialAccount") && request()->get("socialAccount") != ""){
				$items = $items->where("socialAccount","=", request()->get("socialAccount"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.becomeinstructor.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.becomeinstructor.edit' , $id);
     }

     public function store(AddRequestBecomeInstructor $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('becomeinstructor');
     }

     public function update($id , UpdateRequestBecomeInstructor $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.becomeinstructor.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'becomeinstructor')->with('sucess' , 'Done Delete BecomeInstructor From system');
     }


}
