<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Requests\Website\Quizstudentsstatus\AddRequestQuizstudentsstatus;
use App\Application\Requests\Website\Quizstudentsstatus\UpdateRequestQuizstudentsstatus;

class QuizstudentsstatusController extends AbstractController
{

     public function __construct(Quizstudentsstatus $model)
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

			if(request()->has("start_time") && request()->get("start_time") != ""){
				$items = $items->where("start_time","=", request()->get("start_time"));
			}

			if(request()->has("end_time") && request()->get("end_time") != ""){
				$items = $items->where("end_time","=", request()->get("end_time"));
			}

			if(request()->has("pause_time") && request()->get("pause_time") != ""){
				$items = $items->where("pause_time","=", request()->get("pause_time"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}

			if(request()->has("skipped_question_id") && request()->get("skipped_question_id") != ""){
				$items = $items->where("skipped_question_id","=", request()->get("skipped_question_id"));
			}

			if(request()->has("passed") && request()->get("passed") != ""){
				$items = $items->where("passed","=", request()->get("passed"));
			}

			if(request()->has("exam_anytime") && request()->get("exam_anytime") != ""){
				$items = $items->where("exam_anytime","=", request()->get("exam_anytime"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.quizstudentsstatus.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.quizstudentsstatus.edit' , $id);
     }

     public function store(AddRequestQuizstudentsstatus $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('quizstudentsstatus');
     }

     public function update($id , UpdateRequestQuizstudentsstatus $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.quizstudentsstatus.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'quizstudentsstatus')->with('sucess' , 'Done Delete Quizstudentsstatus From system');
     }

     public function answers($id){

         $quizStudentStatus = Quizstudentsstatus::findOrFail($id);
         $course = $quizStudentStatus->quiz->courses;

         return view('website.quizstudentsstatus.answers', ['quizStudentStatus' => $quizStudentStatus, 'course' => $course]);
     }


}
