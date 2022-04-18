<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Careers;
use App\Application\Requests\Website\Careers\AddRequestCareers;
use App\Application\Requests\Website\Careers\UpdateRequestCareers;

class CareersController extends AbstractController
{

     public function __construct(Careers $model)
     {
        parent::__construct($model);
     }

     public function index(){
       
       $this->data['title'] = trans('careers.careers');

       $this->data['careers'] = Careers::all();

       return view('website.careers', $this->data);

     }
     
     public function sendJobApp($emailFrom, Careers $career, $cv){

        dd($emailFrom);


    }

     public function show($id = null){
         return $this->createOrEdit('website.careers.edit' , $id);
     }

     public function store(AddRequestCareers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('careers');
     }

     public function update($id , UpdateRequestCareers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.careers.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'careers')->with('sucess' , 'Done Delete Careers From system');
     }


}
