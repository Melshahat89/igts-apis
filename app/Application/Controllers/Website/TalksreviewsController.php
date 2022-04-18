<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Talksreviews;
use App\Application\Requests\Website\Talksreviews\AddRequestTalksreviews;
use App\Application\Requests\Website\Talksreviews\UpdateRequestTalksreviews;
use Illuminate\Support\Facades\Auth;
class TalksreviewsController extends AbstractController
{

     public function __construct(Talksreviews $model)
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

			if(request()->has("review") && request()->get("review") != ""){
				$items = $items->where("review","=", request()->get("review"));
			}

			if(request()->has("rating") && request()->get("rating") != ""){
				$items = $items->where("rating","=", request()->get("rating"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.talksreviews.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.talksreviews.edit' , $id);
     }

     public function store(AddRequestTalksreviews $request){
          if(Auth::check()){
            $request->request->add(['user_id' =>  Auth::user()->id]); //add user_id
        }

          $item =  $this->storeOrUpdate($request , null , true);
          alert()->success(trans('website.Your review has been added successfully') , trans('website.Success'));
          return redirect()->back();
     }

     public function update($id , UpdateRequestTalksreviews $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.talksreviews.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'talksreviews')->with('sucess' , 'Done Delete Talksreviews From system');
     }


}
