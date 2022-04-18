<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Ticketsreplay;
use App\Application\Requests\Website\Ticketsreplay\AddRequestTicketsreplay;
use App\Application\Requests\Website\Ticketsreplay\UpdateRequestTicketsreplay;

class TicketsreplayController extends AbstractController
{

     public function __construct(Ticketsreplay $model)
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

			if(request()->has("message") && request()->get("message") != ""){
				$items = $items->where("message","=", request()->get("message"));
			}

			if(request()->has("reciver_id") && request()->get("reciver_id") != ""){
				$items = $items->where("reciver_id","=", request()->get("reciver_id"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.ticketsreplay.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.ticketsreplay.edit' , $id);
     }

     public function store(AddRequestTicketsreplay $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('ticketsreplay');
     }

     public function update($id , UpdateRequestTicketsreplay $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.ticketsreplay.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'ticketsreplay')->with('sucess' , 'Done Delete Ticketsreplay From system');
     }


}
