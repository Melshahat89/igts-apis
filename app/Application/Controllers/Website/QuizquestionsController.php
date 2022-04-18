<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Quizquestions;
use App\Application\Requests\Website\Quizquestions\AddRequestQuizquestions;
use App\Application\Requests\Website\Quizquestions\UpdateRequestQuizquestions;

class QuizquestionsController extends AbstractController
{

     public function __construct(Quizquestions $model)
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

			if(request()->has("question") && request()->get("question") != ""){
				$items = $items->where("question","like", "%".request()->get("question")."%");
			}

			if(request()->has("type") && request()->get("type") != ""){
				$items = $items->where("type","=", request()->get("type"));
			}

			if(request()->has("mark") && request()->get("mark") != ""){
				$items = $items->where("mark","=", request()->get("mark"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.quizquestions.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.quizquestions.edit' , $id);
     }

     public function store(AddRequestQuizquestions $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('quizquestions');
     }

     public function update($id , UpdateRequestQuizquestions $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.quizquestions.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'quizquestions')->with('sucess' , 'Done Delete Quizquestions From system');
     }


}
