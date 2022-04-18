<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Homesettings;
use App\Application\Requests\Website\Homesettings\AddRequestHomesettings;
use App\Application\Requests\Website\Homesettings\UpdateRequestHomesettings;

class HomesettingsController extends AbstractController
{

     public function __construct(Homesettings $model)
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

			if(request()->has("bundles") && request()->get("bundles") != ""){
				$items = $items->where("bundles","=", request()->get("bundles"));
			}

			if(request()->has("featured_courses") && request()->get("featured_courses") != ""){
				$items = $items->where("featured_courses","=", request()->get("featured_courses"));
			}

			if(request()->has("events") && request()->get("events") != ""){
				$items = $items->where("events","=", request()->get("events"));
			}

			if(request()->has("talks") && request()->get("talks") != ""){
				$items = $items->where("talks","=", request()->get("talks"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.homesettings.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.homesettings.edit' , $id);
     }

     public function store(AddRequestHomesettings $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('homesettings');
     }

     public function update($id , UpdateRequestHomesettings $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.homesettings.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'homesettings')->with('sucess' , 'Done Delete Homesettings From system');
     }


}
