<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Lectures3d;
use App\Application\Requests\Website\Lectures3d\AddRequestLectures3d;
use App\Application\Requests\Website\Lectures3d\UpdateRequestLectures3d;

class Lectures3dController extends AbstractController
{

     public function __construct(Lectures3d $model)
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
				$items = $items->where("title","=", request()->get("title"));
			}

			if(request()->has("link") && request()->get("link") != ""){
				$items = $items->where("link","=", request()->get("link"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.lectures3d.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.lectures3d.edit' , $id);
     }

     public function store(AddRequestLectures3d $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lectures3d');
     }

     public function update($id , UpdateRequestLectures3d $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.lectures3d.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'lectures3d')->with('sucess' , 'Done Delete Lectures3d From system');
     }


}
