<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Talklikes;
use App\Application\Requests\Website\Talklikes\AddRequestTalklikes;
use App\Application\Requests\Website\Talklikes\UpdateRequestTalklikes;

class TalklikesController extends AbstractController
{

     public function __construct(Talklikes $model)
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

			if(request()->has("comment") && request()->get("comment") != ""){
				$items = $items->where("comment","=", request()->get("comment"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.talklikes.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.talklikes.edit' , $id);
     }

     public function store(AddRequestTalklikes $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('talklikes');
     }

     public function update($id , UpdateRequestTalklikes $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.talklikes.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'talklikes')->with('sucess' , 'Done Delete Talklikes From system');
     }


}
