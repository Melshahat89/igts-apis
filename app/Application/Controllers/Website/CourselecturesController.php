<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Courselectures;
use App\Application\Model\Courses;
use App\Application\Requests\Website\Courselectures\AddRequestCourselectures;
use App\Application\Requests\Website\Courselectures\UpdateRequestCourselectures;
use Illuminate\Support\Facades\Auth;

class CourselecturesController extends AbstractController
{

     public function __construct(Courselectures $model)
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

			if(request()->has("slug") && request()->get("slug") != ""){
				$items = $items->where("slug","=", request()->get("slug"));
			}

			if(request()->has("description") && request()->get("description") != ""){
				$items = $items->where("description","like", "%".request()->get("description")."%");
			}

			if(request()->has("video_file") && request()->get("video_file") != ""){
				$items = $items->where("video_file","=", request()->get("video_file"));
			}

			if(request()->has("length") && request()->get("length") != ""){
				$items = $items->where("length","=", request()->get("length"));
			}

			if(request()->has("is_free") && request()->get("is_free") != ""){
				$items = $items->where("is_free","=", request()->get("is_free"));
			}

			if(request()->has("position") && request()->get("position") != ""){
				$items = $items->where("position","=", request()->get("position"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.courselectures.index' , compact('items'));
     }

     public function show($id = null){

        $lecture = Courselectures::findOrFail($id);
        $course = Courses::where('instructor_id', Auth::user()->id)->findOrFail($lecture->courses_id);


         return $this->createOrEdit('website.courselectures.edit' , $id);
     }

     public function store(AddRequestCourselectures $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('courselectures');
     }

     public function update($id , UpdateRequestCourselectures $request){
          $item = $this->storeOrUpdate($request, $id, true);

          $course_id = Courselectures::find($id)->courses->id;
          
return redirect('/partnership/addLectures/' . $course_id);

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.courselectures.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'courselectures')->with('sucess' , 'Done Delete Courselectures From system');
     }


}
