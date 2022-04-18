<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Quizstudentsanswers;
use App\Application\Requests\Website\Quizstudentsanswers\AddRequestQuizstudentsanswers;
use App\Application\Requests\Website\Quizstudentsanswers\UpdateRequestQuizstudentsanswers;

class QuizstudentsanswersController extends AbstractController
{

     public function __construct(Quizstudentsanswers $model)
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

			if(request()->has("is_correct") && request()->get("is_correct") != ""){
				$items = $items->where("is_correct","=", request()->get("is_correct"));
			}

			if(request()->has("answered") && request()->get("answered") != ""){
				$items = $items->where("answered","=", request()->get("answered"));
			}

			if(request()->has("mark") && request()->get("mark") != ""){
				$items = $items->where("mark","=", request()->get("mark"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.quizstudentsanswers.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.quizstudentsanswers.edit' , $id);
     }

     public function store(AddRequestQuizstudentsanswers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('quizstudentsanswers');
     }

     public function update($id , UpdateRequestQuizstudentsanswers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.quizstudentsanswers.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'quizstudentsanswers')->with('sucess' , 'Done Delete Quizstudentsanswers From system');
     }


}
