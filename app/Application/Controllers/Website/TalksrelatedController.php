<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Talksrelated;
use App\Application\Requests\Website\Talksrelated\AddRequestTalksrelated;
use App\Application\Requests\Website\Talksrelated\UpdateRequestTalksrelated;

class TalksrelatedController extends AbstractController
{

     public function __construct(Talksrelated $model)
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

			if(request()->has("position") && request()->get("position") != ""){
				$items = $items->where("position","=", request()->get("position"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.talksrelated.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.talksrelated.edit' , $id);
     }

     public function store(AddRequestTalksrelated $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('talksrelated');
     }

     public function update($id , UpdateRequestTalksrelated $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.talksrelated.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'talksrelated')->with('sucess' , 'Done Delete Talksrelated From system');
     }


}
