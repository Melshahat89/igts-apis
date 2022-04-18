<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Eventsenrollment;
use App\Application\Requests\Website\Eventsenrollment\AddRequestEventsenrollment;
use App\Application\Requests\Website\Eventsenrollment\UpdateRequestEventsenrollment;

class EventsenrollmentController extends AbstractController
{

     public function __construct(Eventsenrollment $model)
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

			if(request()->has("start_time") && request()->get("start_time") != ""){
				$items = $items->where("start_time","=", request()->get("start_time"));
			}

			if(request()->has("end_time") && request()->get("end_time") != ""){
				$items = $items->where("end_time","=", request()->get("end_time"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.eventsenrollment.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.eventsenrollment.edit' , $id);
     }

     public function store(AddRequestEventsenrollment $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('eventsenrollment');
     }

     public function update($id , UpdateRequestEventsenrollment $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.eventsenrollment.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'eventsenrollment')->with('sucess' , 'Done Delete Eventsenrollment From system');
     }


}
