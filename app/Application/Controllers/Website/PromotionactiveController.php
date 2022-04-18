<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Promotionactive;
use App\Application\Requests\Website\Promotionactive\AddRequestPromotionactive;
use App\Application\Requests\Website\Promotionactive\UpdateRequestPromotionactive;

class PromotionactiveController extends AbstractController
{

     public function __construct(Promotionactive $model)
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



        $items = $items->paginate(env('PAGINATE'));
        return view('website.promotionactive.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.promotionactive.edit' , $id);
     }

     public function store(AddRequestPromotionactive $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('promotionactive');
     }

     public function update($id , UpdateRequestPromotionactive $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.promotionactive.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'promotionactive')->with('sucess' , 'Done Delete Promotionactive From system');
     }


}
