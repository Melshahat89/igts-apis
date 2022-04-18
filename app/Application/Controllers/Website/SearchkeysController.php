<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Searchkeys;
use App\Application\Requests\Website\Searchkeys\AddRequestSearchkeys;
use App\Application\Requests\Website\Searchkeys\UpdateRequestSearchkeys;

class SearchkeysController extends AbstractController
{

     public function __construct(Searchkeys $model)
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

			if(request()->has("word") && request()->get("word") != ""){
				$items = $items->where("word","=", request()->get("word"));
			}

			if(request()->has("ip") && request()->get("ip") != ""){
				$items = $items->where("ip","=", request()->get("ip"));
			}

			if(request()->has("country") && request()->get("country") != ""){
				$items = $items->where("country","=", request()->get("country"));
			}

			if(request()->has("city") && request()->get("city") != ""){
				$items = $items->where("city","=", request()->get("city"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.searchkeys.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.searchkeys.edit' , $id);
     }

     public function store(AddRequestSearchkeys $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('searchkeys');
     }

     public function update($id , UpdateRequestSearchkeys $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.searchkeys.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'searchkeys')->with('sucess' , 'Done Delete Searchkeys From system');
     }


}
