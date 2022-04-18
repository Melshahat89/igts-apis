<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Quiz;
use App\Application\Requests\Website\Quiz\AddRequestQuiz;
use App\Application\Requests\Website\Quiz\UpdateRequestQuiz;

class QuizController extends AbstractController
{

     public function __construct(Quiz $model)
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

			if(request()->has("instructions") && request()->get("instructions") != ""){
				$items = $items->where("instructions","=", request()->get("instructions"));
			}

			if(request()->has("time") && request()->get("time") != ""){
				$items = $items->where("time","=", request()->get("time"));
			}

			if(request()->has("time_in_mins") && request()->get("time_in_mins") != ""){
				$items = $items->where("time_in_mins","=", request()->get("time_in_mins"));
			}

			if(request()->has("type") && request()->get("type") != ""){
				$items = $items->where("type","=", request()->get("type"));
			}

			if(request()->has("pass_percentage") && request()->get("pass_percentage") != ""){
				$items = $items->where("pass_percentage","=", request()->get("pass_percentage"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.quiz.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.quiz.edit' , $id);
     }

     public function store(AddRequestQuiz $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('quiz');
     }

     public function update($id , UpdateRequestQuiz $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.quiz.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'quiz')->with('sucess' , 'Done Delete Quiz From system');
     }


}
