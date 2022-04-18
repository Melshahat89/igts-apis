<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Coursereviews;
use App\Application\Requests\Website\Coursereviews\AddRequestCoursereviews;
use App\Application\Requests\Website\Coursereviews\UpdateRequestCoursereviews;
use Illuminate\Support\Facades\Auth;

class CoursereviewsController extends AbstractController
{

     public function __construct(Coursereviews $model)
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

			if(request()->has("review") && request()->get("review") != ""){
				$items = $items->where("review","=", request()->get("review"));
			}

			if(request()->has("rating") && request()->get("rating") != ""){
				$items = $items->where("rating","=", request()->get("rating"));
			}

			if(request()->has("type") && request()->get("type") != ""){
				$items = $items->where("type","=", request()->get("type"));
			}

			if(request()->has("manual_name") && request()->get("manual_name") != ""){
				$items = $items->where("manual_name","=", request()->get("manual_name"));
			}

			if(request()->has("manual_image") && request()->get("manual_image") != ""){
				$items = $items->where("manual_image","=", request()->get("manual_image"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.coursereviews.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.coursereviews.edit' , $id);
     }

     public function store(AddRequestCoursereviews $request){

        if(Auth::check()){
            $request->request->add(['user_id' =>  Auth::user()->id]); //add user_id
        }

          $item =  $this->storeOrUpdate($request , null , true);
          alert()->success(trans('website.Your review has been added successfully') , trans('website.Success'));
          return redirect()->back();
     }

     public function update($id , UpdateRequestCoursereviews $request){
            $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.coursereviews.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'coursereviews')->with('sucess' , 'Done Delete Coursereviews From system');
     }


}
