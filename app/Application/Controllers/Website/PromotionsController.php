<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Promotions;
use App\Application\Requests\Website\Promotions\AddRequestPromotions;
use App\Application\Requests\Website\Promotions\UpdateRequestPromotions;

class PromotionsController extends AbstractController
{

     public function __construct(Promotions $model)
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

			if(request()->has("title") && request()->get("title") != ""){
				$items = $items->where("title","=", request()->get("title"));
			}

			if(request()->has("description") && request()->get("description") != ""){
				$items = $items->where("description","=", request()->get("description"));
			}

			if(request()->has("type") && request()->get("type") != ""){
				$items = $items->where("type","=", request()->get("type"));
			}

			if(request()->has("value_for_egp") && request()->get("value_for_egp") != ""){
				$items = $items->where("value_for_egp","=", request()->get("value_for_egp"));
			}

			if(request()->has("value_for_other_currencies") && request()->get("value_for_other_currencies") != ""){
				$items = $items->where("value_for_other_currencies","=", request()->get("value_for_other_currencies"));
			}

			if(request()->has("code") && request()->get("code") != ""){
				$items = $items->where("code","=", request()->get("code"));
			}

			if(request()->has("start_date") && request()->get("start_date") != ""){
				$items = $items->where("start_date","=", request()->get("start_date"));
			}

			if(request()->has("expiration_date") && request()->get("expiration_date") != ""){
				$items = $items->where("expiration_date","=", request()->get("expiration_date"));
			}

			if(request()->has("active") && request()->get("active") != ""){
				$items = $items->where("active","=", request()->get("active"));
			}

			if(request()->has("promotion_limit") && request()->get("promotion_limit") != ""){
				$items = $items->where("promotion_limit","=", request()->get("promotion_limit"));
			}

			if(request()->has("promotion_usage") && request()->get("promotion_usage") != ""){
				$items = $items->where("promotion_usage","=", request()->get("promotion_usage"));
			}

			if(request()->has("publish_as_notification") && request()->get("publish_as_notification") != ""){
				$items = $items->where("publish_as_notification","=", request()->get("publish_as_notification"));
			}

			if(request()->has("notification_message") && request()->get("notification_message") != ""){
				$items = $items->where("notification_message","=", request()->get("notification_message"));
			}

			if(request()->has("include_courses") && request()->get("include_courses") != ""){
				$items = $items->where("include_courses","=", request()->get("include_courses"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.promotions.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.promotions.edit' , $id);
     }

     public function store(AddRequestPromotions $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('promotions');
     }

     public function update($id , UpdateRequestPromotions $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.promotions.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'promotions')->with('sucess' , 'Done Delete Promotions From system');
     }


}
