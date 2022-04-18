<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Slider;
use App\Application\Requests\Website\Slider\AddRequestSlider;
use App\Application\Requests\Website\Slider\UpdateRequestSlider;

class SliderController extends AbstractController
{

     public function __construct(Slider $model)
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
				$items = $items->where("title","like", "%".request()->get("title")."%");
			}

			if(request()->has("description") && request()->get("description") != ""){
				$items = $items->where("description","like", "%".request()->get("description")."%");
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.slider.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.slider.edit' , $id);
     }

     public function store(AddRequestSlider $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('slider');
     }

     public function update($id , UpdateRequestSlider $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.slider.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'slider')->with('sucess' , 'Done Delete Slider From system');
     }


}
