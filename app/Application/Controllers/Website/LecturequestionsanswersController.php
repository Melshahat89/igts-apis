<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Lecturequestions;
use App\Application\Model\Lecturequestionsanswers;
use App\Application\Model\User;
use App\Application\Requests\Website\Lecturequestionsanswers\AddRequestLecturequestionsanswers;
use App\Application\Requests\Website\Lecturequestionsanswers\UpdateRequestLecturequestionsanswers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LecturequestionsanswersController extends AbstractController
{

     public function __construct(Lecturequestionsanswers $model)
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

			if(request()->has("answer") && request()->get("answer") != ""){
				$items = $items->where("answer","=", request()->get("answer"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.lecturequestionsanswers.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.lecturequestionsanswers.edit' , $id);
     }

     public function store(AddRequestLecturequestionsanswers $request){
        if(Auth::check()){
            $request->request->add(['user_id' =>  Auth::user()->id]); //add user_id
            // $request->request->add(['approve' =>  0]);
            if(isset($request->all()['instructor_id']) && $request->all()['instructor_id'] == Auth::user()->id){
                $request->request->add(['is_instructor' => 1]); //add user_id
            }
        }

        
        $lectureQuestion = Lecturequestions::findOrFail(request()->get('lecturequestions_id'));

        // dd($lectureQuestion['user']['id']);

        if($lectureQuestion['courselectures']['courses']['instructor']['id'] != Auth::user()->id){
            return redirect()->back();
        }
        // dd($lectureQuestion['courselectures']['courses']['instructor']['id']);
          $item =  $this->storeOrUpdate($request , null , true);

          User::addNotification([$lectureQuestion['user']['id']], trans('messages.notificationNewAnswerTitle'), $lectureQuestion->question_title, '/courses/courseLecture/id/'.$lectureQuestion['courselectures']['id']);
          

        alert()->success(trans('website.Your question has been added successfully') , trans('website.Success'));
        return redirect()->back();

        //   return redirect('lecturequestionsanswers');
     }

     public function storeAjax(){

        if(isset($_GET['test'])){
            $params = array();
            
            parse_str($_GET['test'], $params);

            $request = new Request($params);

            if(Auth::check()){
                $request->request->add(['user_id' =>  Auth::user()->id]); //add user_id
            }

            $item =  $this->storeOrUpdate($request , null , true);

        }


        return response()->json(['success'=>true, 'answer'=>$request->all(), 'answer_id' => $item->id, 'user_name' => Auth::user()->name, 'date' => $item->created_at->format('d m Y')], 200);



     }

     public function update($id , UpdateRequestLecturequestionsanswers $request){
            $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.lecturequestionsanswers.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'lecturequestionsanswers')->with('sucess' , 'Done Delete Lecturequestionsanswers From system');
     }


}
