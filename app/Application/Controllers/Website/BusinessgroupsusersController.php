<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Businessgroupsusers;
use App\Application\Requests\Website\Businessgroupsusers\AddRequestBusinessgroupsusers;
use App\Application\Requests\Website\Businessgroupsusers\UpdateRequestBusinessgroupsusers;

class BusinessgroupsusersController extends AbstractController
{

     public function __construct(Businessgroupsusers $model)
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

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}

			if(request()->has("note") && request()->get("note") != ""){
				$items = $items->where("note","=", request()->get("note"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.businessgroupsusers.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.businessgroupsusers.edit' , $id);
     }

     public function store(AddRequestBusinessgroupsusers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('businessgroupsusers');
     }

     public function update($id , UpdateRequestBusinessgroupsusers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.businessgroupsusers.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'businessgroupsusers')->with('sucess' , 'Done Delete Businessgroupsusers From system');
     }


}
