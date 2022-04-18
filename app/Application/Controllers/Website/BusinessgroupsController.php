<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Businessgroups;
use App\Application\Requests\Website\Businessgroups\AddRequestBusinessgroups;
use App\Application\Requests\Website\Businessgroups\UpdateRequestBusinessgroups;
use Illuminate\Support\Facades\Auth;

class BusinessgroupsController extends AbstractController
{

     public function __construct(Businessgroups $model)
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
				$items = $items->where("name","=", request()->get("name"));
			}

			if(request()->has("parent_id") && request()->get("parent_id") != ""){
				$items = $items->where("parent_id","=", request()->get("parent_id"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.businessgroups.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.businessgroups.edit' , $id);
     }

     public function store(AddRequestBusinessgroups $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('businessgroups');
     }

     public function update($id , UpdateRequestBusinessgroups $request){

        dd($id);
            $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.businessgroups.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
        $fields = $this->model->findOrFail($id);

        if($fields->businessdata->manager->id != Auth::user()->id){
            abort('404');
        }



        $this->deleteItem($id , 'businessdomains')->with('sucess' , 'Done Delete Businessdomains From system');

        $fields->businessgroupscoursesrows()->delete();

        return redirect()->back(); 
    }


}
