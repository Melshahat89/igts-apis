<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Testimonials;
use App\Application\Requests\Website\Testimonials\AddRequestTestimonials;
use App\Application\Requests\Website\Testimonials\UpdateRequestTestimonials;

class TestimonialsController extends AbstractController
{

     public function __construct(Testimonials $model)
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

			if(request()->has("name") && request()->get("name") != ""){
				$items = $items->where("name","like", "%".request()->get("name")."%");
			}

			if(request()->has("title") && request()->get("title") != ""){
				$items = $items->where("title","like", "%".request()->get("title")."%");
			}

			if(request()->has("message") && request()->get("message") != ""){
				$items = $items->where("message","like", "%".request()->get("message")."%");
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.testimonials.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.testimonials.edit' , $id);
     }

     public function store(AddRequestTestimonials $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('testimonials');
     }

     public function update($id , UpdateRequestTestimonials $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.testimonials.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'testimonials')->with('sucess' , 'Done Delete Testimonials From system');
     }


}
