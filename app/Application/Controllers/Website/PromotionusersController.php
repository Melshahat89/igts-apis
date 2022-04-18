<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Promotionusers;
use App\Application\Requests\Website\Promotionusers\AddRequestPromotionusers;
use App\Application\Requests\Website\Promotionusers\UpdateRequestPromotionusers;

class PromotionusersController extends AbstractController
{

     public function __construct(Promotionusers $model)
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

			if(request()->has("used") && request()->get("used") != ""){
				$items = $items->where("used","=", request()->get("used"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.promotionusers.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.promotionusers.edit' , $id);
     }

     public function store(AddRequestPromotionusers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('promotionusers');
     }

     public function update($id , UpdateRequestPromotionusers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.promotionusers.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'promotionusers')->with('sucess' , 'Done Delete Promotionusers From system');
     }


}
