<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Institution;
use App\Application\Model\Masterrequest;
use App\Application\Requests\Website\Institution\AddRequestInstitution;
use App\Application\Requests\Website\Institution\UpdateRequestInstitution;
use Illuminate\Support\Facades\Auth;

class InstitutionController extends AbstractController
{

     public function __construct(Institution $model)
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

			if(request()->has("temp1") && request()->get("temp1") != ""){
				$items = $items->where("temp1","=", request()->get("temp1"));
			}

			if(request()->has("temp2") && request()->get("temp2") != ""){
				$items = $items->where("temp2","=", request()->get("temp2"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.institution.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.institution.edit' , $id);
     }

     public function store(AddRequestInstitution $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('institution');
     }

     public function update($id , UpdateRequestInstitution $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.institution.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'institution')->with('sucess' , 'Done Delete Institution From system');
     }

     public function home(){

        $this->data['items'] = Masterrequest::whereHas('courses', function ($query) {
            return $query->where('instructor_id', Auth::user()->id);
        })->paginate(env('PAGINATE'));



        return view('website.institution.home', $this->data);
     }
}
