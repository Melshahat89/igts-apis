<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Partners;
use App\Application\Requests\Website\Partners\AddRequestPartners;
use App\Application\Requests\Website\Partners\UpdateRequestPartners;

class PartnersController extends AbstractController
{

     public function __construct(Partners $model)
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

			if(request()->has("seo_desc") && request()->get("seo_desc") != ""){
				$items = $items->where("seo_desc","like", "%".request()->get("seo_desc")."%");
			}

			if(request()->has("seo_keys") && request()->get("seo_keys") != ""){
				$items = $items->where("seo_keys","like", "%".request()->get("seo_keys")."%");
			}

			if(request()->has("search_keys") && request()->get("search_keys") != ""){
				$items = $items->where("search_keys","like", "%".request()->get("search_keys")."%");
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.partners.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.partners.edit' , $id);
     }

     public function store(AddRequestPartners $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('partners');
     }

     public function update($id , UpdateRequestPartners $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.partners.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'partners')->with('sucess' , 'Done Delete Partners From system');
     }


}
