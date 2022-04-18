<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Careersresponses;
use App\Application\Requests\Website\Careersresponses\AddRequestCareersresponses;
use App\Application\Requests\Website\Careersresponses\UpdateRequestCareersresponses;

class CareersresponsesController extends AbstractController
{

     public function __construct(Careersresponses $model)
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

			if(request()->has("mobile") && request()->get("mobile") != ""){
				$items = $items->where("mobile","=", request()->get("mobile"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.careersresponses.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.careersresponses.edit' , $id);
     }

     public function store(AddRequestCareersresponses $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('careersresponses');
     }

     public function update($id , UpdateRequestCareersresponses $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.careersresponses.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'careersresponses')->with('sucess' , 'Done Delete Careersresponses From system');
     }


}
