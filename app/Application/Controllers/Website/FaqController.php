<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Faq;
use App\Application\Requests\Website\Faq\AddRequestFaq;
use App\Application\Requests\Website\Faq\UpdateRequestFaq;

class FaqController extends AbstractController
{

     public function __construct(Faq $model)
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

			if(request()->has("group_id") && request()->get("group_id") != ""){
				$items = $items->where("group_id","=", request()->get("group_id"));
			}

			if(request()->has("question") && request()->get("question") != ""){
				$items = $items->where("question","like", "%".request()->get("question")."%");
			}

			if(request()->has("answer") && request()->get("answer") != ""){
				$items = $items->where("answer","like", "%".request()->get("answer")."%");
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.faq.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.faq.edit' , $id);
     }

     public function store(AddRequestFaq $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('faq');
     }

     public function update($id , UpdateRequestFaq $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.faq.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'faq')->with('sucess' , 'Done Delete Faq From system');
     }


}
