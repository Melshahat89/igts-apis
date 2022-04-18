<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Ordersposition;
use App\Application\Requests\Website\Ordersposition\AddRequestOrdersposition;
use App\Application\Requests\Website\Ordersposition\UpdateRequestOrdersposition;

class OrderspositionController extends AbstractController
{

     public function __construct(Ordersposition $model)
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

			if(request()->has("amount") && request()->get("amount") != ""){
				$items = $items->where("amount","=", request()->get("amount"));
			}

			if(request()->has("notes") && request()->get("notes") != ""){
				$items = $items->where("notes","=", request()->get("notes"));
			}

			if(request()->has("certificate_id") && request()->get("certificate_id") != ""){
				$items = $items->where("certificate_id","=", request()->get("certificate_id"));
			}

			if(request()->has("shipping_id") && request()->get("shipping_id") != ""){
				$items = $items->where("shipping_id","=", request()->get("shipping_id"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.ordersposition.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.ordersposition.edit' , $id);
     }

     public function store(AddRequestOrdersposition $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('ordersposition');
     }

     public function update($id , UpdateRequestOrdersposition $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.ordersposition.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'ordersposition')->with('sucess' , 'Done Delete Ordersposition From system');
     }


}
