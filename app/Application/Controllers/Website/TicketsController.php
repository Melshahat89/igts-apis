<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Tickets;
use App\Application\Requests\Website\Tickets\AddRequestTickets;
use App\Application\Requests\Website\Tickets\UpdateRequestTickets;
use Illuminate\Support\Facades\Auth;

class TicketsController extends AbstractController
{

     public function __construct(Tickets $model)
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

			if(request()->has("reciver_id") && request()->get("reciver_id") != ""){
				$items = $items->where("reciver_id","=", request()->get("reciver_id"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}

			if(request()->has("type") && request()->get("type") != ""){
				$items = $items->where("type","=", request()->get("type"));
			}

			if(request()->has("title") && request()->get("title") != ""){
				$items = $items->where("title","=", request()->get("title"));
			}

			if(request()->has("message") && request()->get("message") != ""){
				$items = $items->where("message","=", request()->get("message"));
			}

			if(request()->has("priority") && request()->get("priority") != ""){
				$items = $items->where("priority","=", request()->get("priority"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.tickets.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.tickets.edit' , $id);
     }

     public function store(AddRequestTickets $request){
        $request->request->add(['user_id' => Auth::user()->id]); 
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('business/tickets');
     }

     public function update($id , UpdateRequestTickets $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.tickets.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'tickets')->with('sucess' , 'Done Delete Tickets From system');
     }


}
