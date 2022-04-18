<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Transactions;
use App\Application\Requests\Website\Transactions\AddRequestTransactions;
use App\Application\Requests\Website\Transactions\UpdateRequestTransactions;

class TransactionsController extends AbstractController
{

     public function __construct(Transactions $model)
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

			if(request()->has("price") && request()->get("price") != ""){
				$items = $items->where("price","=", request()->get("price"));
			}

			if(request()->has("currency") && request()->get("currency") != ""){
				$items = $items->where("currency","=", request()->get("currency"));
			}

			if(request()->has("percent") && request()->get("percent") != ""){
				$items = $items->where("percent","=", request()->get("percent"));
			}

			if(request()->has("amount") && request()->get("amount") != ""){
				$items = $items->where("amount","=", request()->get("amount"));
			}

			if(request()->has("type") && request()->get("type") != ""){
				$items = $items->where("type","=", request()->get("type"));
			}

			if(request()->has("date") && request()->get("date") != ""){
				$items = $items->where("date","=", request()->get("date"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.transactions.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.transactions.edit' , $id);
     }

     public function store(AddRequestTransactions $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('transactions');
     }

     public function update($id , UpdateRequestTransactions $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.transactions.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'transactions')->with('sucess' , 'Done Delete Transactions From system');
     }


}
