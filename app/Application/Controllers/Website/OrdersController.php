<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Orders;
use App\Application\Requests\Website\Orders\AddRequestOrders;
use App\Application\Requests\Website\Orders\UpdateRequestOrders;

class OrdersController extends AbstractController
{

     public function __construct(Orders $model)
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

			if(request()->has("comments") && request()->get("comments") != ""){
				$items = $items->where("comments","=", request()->get("comments"));
			}

			if(request()->has("billing_address_id") && request()->get("billing_address_id") != ""){
				$items = $items->where("billing_address_id","=", request()->get("billing_address_id"));
			}

			if(request()->has("accept_order_id") && request()->get("accept_order_id") != ""){
				$items = $items->where("accept_order_id","=", request()->get("accept_order_id"));
			}

			if(request()->has("kiosk_id") && request()->get("kiosk_id") != ""){
				$items = $items->where("kiosk_id","=", request()->get("kiosk_id"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.orders.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.orders.edit' , $id);
     }

     public function store(AddRequestOrders $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('orders');
     }

     public function update($id , UpdateRequestOrders $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.orders.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'orders')->with('sucess' , 'Done Delete Orders From system');
     }


}
