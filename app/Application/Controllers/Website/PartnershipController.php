<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use App\Application\Model\Partnership;
use App\Application\Requests\Website\Partnership\AddRequestPartnership;
use App\Application\Requests\Website\Partnership\UpdateRequestPartnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application\Requests\Website\Courses\AddRequestCourses;
use App\Application\Requests\Website\Courses\UpdateRequestCourses;
use App\Application\Model\Courses;
use App\Application\Requests\Website\Courselectures\AddRequestCourselectures;
use App\Application\Requests\Website\Courselectures\UpdateRequestCourselectures;
use App\Application\Model\Courselectures;
use App\Application\Requests\Website\Coursesections\AddRequestCoursesections;
use App\Application\Requests\Website\Coursesections\UpdateRequestCoursesections;
use App\Application\Model\Coursesections;
use App\Application\Requests\Website\Courseresources\AddRequestCourseresources;
use App\Application\Requests\Website\Courseresources\UpdateRequestCourseresources;
use App\Application\Model\Courseresources;
use App\Application\Model\Quiz;
use App\Application\Requests\Website\Quiz\AddRequestQuiz;
use App\Application\Requests\Website\Quiz\UpdateRequestQuiz;
use App\Application\Requests\Website\Quizquestions\AddRequestQuizquestions;
use App\Application\Requests\Website\Quizquestionschoice\AddRequestQuizquestionschoice;

class PartnershipController extends AbstractController
{

    public function __construct(Partnership $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $items = $this->model;

        if (request()->has('from') && request()->get('from') != '') {
            $items = $items->whereDate('created_at', '>=', request()->get('from'));
        }

        if (request()->has('to') && request()->get('to') != '') {
            $items = $items->whereDate('created_at', '<=', request()->get('to'));
        }

        if (request()->has("setting") && request()->get("setting") != "") {
            $items = $items->where("setting", "=", request()->get("setting"));
        }

        $items = $items->paginate(env('PAGINATE'));
        return view('website.partnership.index', compact('items'));
    }

    public function show($id = null)
    {
        return $this->createOrEdit('website.partnership.edit', $id);
    }

    public function store(AddRequestPartnership $request)
    {
        $item = $this->storeOrUpdate($request, null, true);
        return redirect('partnership');
    }

    public function update($id, UpdateRequestPartnership $request)
    {
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

    }

    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('website.partnership.show', $id, ['fields' => $fields]);
    }

    public function destroyLecture($id)
    {
        $lecture = Courselectures::findOrFail($id);
        $course = Courses::where('instructor_id', Auth::user()->id)->findOrFail($lecture->courses_id);
        $item =app('App\Application\Controllers\Website\CourselecturesController')->destroy($id);

        return redirect()->back();
        
    }

    public function landing()
    {
        return view('website.partnership.landing');
    }
    public function register_individual()
    {
        if(Auth::check()){
           return redirect('/');
        }
        $this->data['title'] = trans('partnership.Individual');
        return view('website.partnership.register_individual', $this->data);
    }
    public function register_institution()
    {
        if(Auth::check()){
           return redirect('/');
        }
        $this->data['title'] = trans('partnership.Institution');
        return view('website.partnership.register_institution', $this->data);
    }
    public function thankyou()
    {
        $this->data['title'] = trans('partnership.Institution');
        return view('website.partnership.thankyou', $this->data);
    }
    
    public function addCourse($id = null)
    {
        if($id){
            $this->data['item'] = Courses::where('instructor_id',Auth::user()->id)->findOrFail($id);
        }
        $this->data['title'] = trans('partnership.Institution');
        return view('website.partnership.addCourse', $this->data);
    }
    public function updateCourse($id, UpdateRequestCourses $request)
    {
        // dd($request);
        $item = app('App\Application\Controllers\Website\CoursesController')->storeOrUpdate($request, $id, true);
        return redirect()->back();

    }
    public function saveCourse(AddRequestCourses $request)
    {
        //dd($request->all());
        $request->request->add(['type' => Courses::TYPE_COURSE]); 
        $request->request->add(['featured' => 0]); 
        $request->request->add(['published' => 0]); 
        $request->request->add(['soon' => 0]); 
        $request->request->add(['is_partnership' => 1]); 
        $request->request->add(['instructor_id' => Auth::user()->id]); 

        $item =app('App\Application\Controllers\Website\CoursesController')->storeOrUpdate($request, null, true);

        alert()->success(trans('partnership.The course has been added successfully'), trans('website.Success'));
        return redirect('partnership/addLectures/'.$item->id);
        
    }
    public function addLectures($id)
    {
        $course = Courses::where('instructor_id',Auth::user()->id)->findOrFail($id);
        $courseSections = Coursesections::where('courses_id',$course->id)->get();
        $videos = Courses::getAllVdocipherCourses($course->slug, 1);

        $this->data['courseSections'] = $courseSections;
        $this->data['videos'] = $videos;
        $this->data['course'] = $course;
        return view('website.partnership.addLectures', $this->data);
    }
    public function saveLecturesSections($id,AddRequestCoursesections $request)
    {
        $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($id);
        $request->request->add(['courses_id' =>  $course->id]); 
        $section =app('App\Application\Controllers\Website\CoursesectionsController')->storeOrUpdate($request, null, true);

        alert()->success(trans('partnership.The section has been added successfully'), trans('website.Success'));
        return redirect('partnership/addLectures/'.$course->id);
        
    }
    public function saveLectures($id,AddRequestCourselectures $request)
    {
        $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($id);
        
        // Add New Request
        $request->request->add(['title' => $request->titleLecture]); 
        $request->request->add(['user_id' => Auth::user()->id]); 
        $request->request->add(['courses_id' => $course->id]); 

        if (request()->has('vdocipher_id') && request()->post('vdocipher_id') != '') {
            $video = Courses::getSpecificVideoVdocipher(request()->post('vdocipher_id'));
            $request->request->add(['length' => isset($video)?$video->length:0]); 
        }

        $item =app('App\Application\Controllers\Website\CourselecturesController')->storeOrUpdate($request, null, true);

        alert()->success(trans('partnership.The lecture has been added successfully'), trans('website.Success'));
        return redirect('partnership/addLectures/'.$course->id);
        
    }
    public function addResources($course_id)
    {
        $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($course_id);

        $this->data['course'] = $course ;
        $this->data['courseResources'] = $course->courseresources;
        return view('website.partnership.addResources', $this->data);
    }

    public function saveResources($course_id,AddRequestCourseresources $request)
    {
        $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($course_id);
        $this->data['course'] = $course ;

        // Add New Request
        $request->request->add(['courses_id' => $course_id]); 
        $item =app('App\Application\Controllers\Website\CourseresourcesController')->storeOrUpdate($request, null, true);
        return redirect()->back();
    }
    
    public function addExams($course_id)
    {
        if(Auth::user()->group_id == 1){
            $course = Courses::findOrFail($course_id);
        }else{
            $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($course_id);
        }

        $this->data['course'] = $course ;
        if($course->quiz){
            $this->data['item'] = $course->quiz;
            $this->data['questions'] = $course->quiz->quizquestions;
        }

        $this->data['courseResources'] = $course->courseresources;
        return view('website.partnership.addExams', $this->data);
    }

    public function saveExams($course_id,$exam = null,AddRequestQuiz $request)
    {

        if(Auth::user()->group_id == 1){
            $course = Courses::findOrFail($course_id);
        }else{
            $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($course_id);
        }

        $this->data['course'] = $course;

        // Add New Request
        $request->request->add(['courses_id' => $course_id]); 

        $item =app('App\Application\Controllers\Website\QuizController')->storeOrUpdate($request, $exam?$exam:null, true);
        return redirect()->back();
    }
    public function saveQuestion($course_id,AddRequestQuizquestions $request)
    {
        if(Auth::user()->group_id == 1){
            $course = Courses::findOrFail($course_id);
        }else{
            $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($course_id);
        }
        $quiz = Quiz::where('courses_id',$course_id)->firstOrFail();

        // Add New Request
        $request->request->add(['quiz_id' => $quiz->id]);  

        $item =app('App\Application\Controllers\Website\QuizquestionsController')->storeOrUpdate($request, null, true);
        return redirect()->back();
    }

    public function saveAnswer($course_id,AddRequestQuizquestionschoice $request)
    {
        if(Auth::user()->group_id == 1){
            $course = Courses::findOrFail($course_id);
        }else{
            $course = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->findOrFail($course_id);
        }        $quiz = Quiz::where('courses_id',$course_id)->firstOrFail();

        // Add New Request

        $item =app('App\Application\Controllers\Website\QuizquestionschoiceController')->storeOrUpdate($request, null, true);
        return redirect()->back();
    }

    public function myCourses()
    {
        if(Auth::user()->group_id == 1){
            $Courses = Courses::where('is_partnership',1)->get();
        }else{
            $Courses = Courses::where('instructor_id',Auth::user()->id)->where('is_partnership',1)->get();
        }
        
        $this->data['Courses'] = $Courses ;
        return view('website.partnership.myCourses', $this->data);
    }
}