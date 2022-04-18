<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Coursewishlist;
use App\Application\Requests\Website\Coursewishlist\AddRequestCoursewishlist;
use App\Application\Requests\Website\Coursewishlist\UpdateRequestCoursewishlist;

class CoursewishlistController extends AbstractController
{

     public function __construct(Coursewishlist $model)
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

			if(request()->has("note") && request()->get("note") != ""){
				$items = $items->where("note","=", request()->get("note"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.coursewishlist.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.coursewishlist.edit' , $id);
     }

     public function store(AddRequestCoursewishlist $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('coursewishlist');
     }

     public function update($id , UpdateRequestCoursewishlist $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.coursewishlist.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'coursewishlist')->with('sucess' , 'Done Delete Coursewishlist From system');
     }


}
