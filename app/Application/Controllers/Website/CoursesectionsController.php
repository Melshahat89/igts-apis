<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Coursesections;
use App\Application\Requests\Website\Coursesections\AddRequestCoursesections;
use App\Application\Requests\Website\Coursesections\UpdateRequestCoursesections;

class CoursesectionsController extends AbstractController
{

     public function __construct(Coursesections $model)
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

			if(request()->has("title") && request()->get("title") != ""){
				$items = $items->where("title","like", "%".request()->get("title")."%");
			}

			if(request()->has("will_do_at_the_end") && request()->get("will_do_at_the_end") != ""){
				$items = $items->where("will_do_at_the_end","like", "%".request()->get("will_do_at_the_end")."%");
			}

			if(request()->has("position") && request()->get("position") != ""){
				$items = $items->where("position","=", request()->get("position"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.coursesections.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.coursesections.edit' , $id);
     }

     public function store(AddRequestCoursesections $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('coursesections');
     }

     public function update($id , UpdateRequestCoursesections $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.coursesections.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'coursesections')->with('sucess' , 'Done Delete Coursesections From system');
     }


}
