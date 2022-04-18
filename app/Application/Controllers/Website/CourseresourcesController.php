<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Courseresources;
use App\Application\Requests\Website\Courseresources\AddRequestCourseresources;
use App\Application\Requests\Website\Courseresources\UpdateRequestCourseresources;

class CourseresourcesController extends AbstractController
{

     public function __construct(Courseresources $model)
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



        $items = $items->paginate(env('PAGINATE'));
        return view('website.courseresources.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.courseresources.edit' , $id);
     }

     public function store(AddRequestCourseresources $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('courseresources');
     }

     public function update($id , UpdateRequestCourseresources $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.courseresources.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'courseresources')->with('sucess' , 'Done Delete Courseresources From system');
     }


}
