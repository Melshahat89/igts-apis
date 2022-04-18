<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Progress;
use App\Application\Requests\Website\Progress\AddRequestProgress;
use App\Application\Requests\Website\Progress\UpdateRequestProgress;

class ProgressController extends AbstractController
{

     public function __construct(Progress $model)
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

			if(request()->has("percentage") && request()->get("percentage") != ""){
				$items = $items->where("percentage","=", request()->get("percentage"));
			}

			if(request()->has("note") && request()->get("note") != ""){
				$items = $items->where("note","=", request()->get("note"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.progress.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.progress.edit' , $id);
     }

     public function store(AddRequestProgress $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('progress');
     }

     public function update($id , UpdateRequestProgress $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.progress.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'progress')->with('sucess' , 'Done Delete Progress From system');
     }


}
