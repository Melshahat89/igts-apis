<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Quizquestionschoice;
use App\Application\Requests\Website\Quizquestionschoice\AddRequestQuizquestionschoice;
use App\Application\Requests\Website\Quizquestionschoice\UpdateRequestQuizquestionschoice;

class QuizquestionschoiceController extends AbstractController
{

     public function __construct(Quizquestionschoice $model)
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

			if(request()->has("choice") && request()->get("choice") != ""){
				$items = $items->where("choice","like", "%".request()->get("choice")."%");
			}

			if(request()->has("is_correct") && request()->get("is_correct") != ""){
				$items = $items->where("is_correct","=", request()->get("is_correct"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.quizquestionschoice.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.quizquestionschoice.edit' , $id);
     }

     public function store(AddRequestQuizquestionschoice $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('quizquestionschoice');
     }

     public function update($id , UpdateRequestQuizquestionschoice $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.quizquestionschoice.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'quizquestionschoice')->with('sucess' , 'Done Delete Quizquestionschoice From system');
     }


}
