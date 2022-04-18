<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Courselectures;
use App\Application\Model\Courses;
use App\Application\Model\Lecturequestions;
use App\Application\Model\User;
use App\Application\Requests\Website\Lecturequestions\AddRequestLecturequestions;
use App\Application\Requests\Website\Lecturequestions\UpdateRequestLecturequestions;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LecturequestionsController extends AbstractController
{

     public function __construct(Lecturequestions $model)
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

			if(request()->has("question_title") && request()->get("question_title") != ""){
				$items = $items->where("question_title","=", request()->get("question_title"));
			}

			if(request()->has("question_description") && request()->get("question_description") != ""){
				$items = $items->where("question_description","=", request()->get("question_description"));
			}

			if(request()->has("approve") && request()->get("approve") != ""){
				$items = $items->where("approve","=", request()->get("approve"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.lecturequestions.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.lecturequestions.edit' , $id);
     }

     public function store(AddRequestLecturequestions $request){


        if(Auth::check()){
            $request->request->add(['user_id' =>  Auth::user()->id]); //add user_id
            $request->request->add(['approve' =>  1]);
        }

        $lecture = Courselectures::findOrFail(request()->get('courselectures_id'));
        $enrolled = Courses::isEnrolledCourse($lecture->courses->id);

        if(!$enrolled){
			abort('403','You don\'t have permission to access this page');
        }
        
        User::addNotification([$lecture->courses->instructor->id], trans('messages.notificationNewQuestionTite'), $lecture->title_en, '/courses/courseLecture/id/'.$lecture->id);

       
        $item =  $this->storeOrUpdate($request , null , true);
        alert()->success(trans('website.Your question has been added successfully') , trans('website.Success'));
        return redirect()->back();
     }

     public function storeAjax(){




        if(isset($_GET['test'])){
            $params = array();
            
            parse_str($_GET['test'], $params);

            $request = new Request($params);

            if(Auth::check()){
                $request->request->add(['user_id' =>  Auth::user()->id]); //add user_id
                $request->request->add(['approve' =>  1]);
            }

            $item =  $this->storeOrUpdate($request , null , true);

        }


        return response()->json(['success'=>true, 'question'=>$request->all(), 'question_id' => $item->id, 'user_name' => Auth::user()->name, 'date' => $item->created_at->format('d m Y')], 200);

     }

     public function update($id , UpdateRequestLecturequestions $request){
            $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.lecturequestions.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'lecturequestions')->with('sucess' , 'Done Delete Lecturequestions From system');
     }


}
