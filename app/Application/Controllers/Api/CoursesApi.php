<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Categories;
use App\Application\Model\Courselectures;
use App\Application\Model\Coursenotes;
use App\Application\Model\Coursereport;
use App\Application\Model\Coursereviews;
use App\Application\Model\Courses;
use App\Application\Model\Coursesections;
use App\Application\Model\Lecturequestions;
use App\Application\Transformers\CourselecturesTransformers;
use App\Application\Transformers\CoursenotesTransformers;
use App\Application\Transformers\CourseresourcesTransformers;
use App\Application\Transformers\CoursesectionsTransformers;
use App\Application\Transformers\CoursesTransformers;
use App\Application\Requests\Website\Courses\ApiAddRequestCourses;
use App\Application\Requests\Website\Courses\ApiUpdateRequestCourses;
use App\Application\Transformers\CourseTransformers;
use App\Application\Transformers\InstructorsTransformers;
use App\Application\Transformers\LecturequestionsTransformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CoursesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courses $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourses $validation){
        return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourses $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {

//        dd(request()->hasHeader("Accept-Language"));
        if (request()->headers->has('lang') && request()->headers->get('lang') == 'ar') {

            return response(apiReturn(array_values(CoursesTransformers::transformAr($data) + $paginate)), $status_code);
        }
//        dd(22);
        return response(apiReturn(array_values(CoursesTransformers::transform($data) + $paginate)), $status_code);
    }

    public function index()
    {
//        dd(auth('api')->check());
        $limit = request()->has('limit') &&  (int) request()->get('limit') != 0 && (int) request()->get('limit') < 30 ? request()->get('limit') : env('PAGINATE');
        $data = $this->model;
        if (request()->has("search_keys") && request()->get("search_keys") != "") {
            $data = $data->where("search_keys", "like", "%" . request()->get("search_keys") . "%");
        }

        if (request()->has("type") && request()->get("type") != "") {
            $data = $data->where("type", "=", request()->get("type"));
        }

        $data = $data->where('published', 1)->orderBy('id' , 'desc')->paginate($limit);

        if ($data AND count($data) > 0) {
            return response(apiReturn(['items' => array_values(CoursesTransformers::transform($data))] + $this->paginateArray($data)), 200);
        }
        return response(apiReturn('', '', trans('website.No Data Found')), 200);
    }

    public function inner(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }

        $course = $this->model->where('id',$request->course_id)->first();
        if($course){
            return response(apiReturn(CourseTransformers::transform($course)), 200);
        }else{
            return response(apiReturn(['error'=>$validator->errors()], '', trans('website.No Data Found')), 401);
        }

    }
    public function lectures(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
//        $course = $this->model->where('id',$request->course_id)->first();
        $lectures = Coursesections::where('courses_id',$request->course_id)->get();

        if($lectures){
            return response(apiReturn(CoursesectionsTransformers::transform($lectures)), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }

    }

    public function requirements(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }

        $course = $this->model->where('id',$request->course_id)->first();
        if($course){
            return response(apiReturn($course->requirments_lang), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }

    }
    public function willlearn(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $course = $this->model->where('id',$request->course_id)->first();
        if($course){
            return response(apiReturn($course->willlearn_lang), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }

    }
    public function instructors(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $course = $this->model->where('id',$request->course_id)->first();
        if($course){
            return response(apiReturn(InstructorsTransformers::transform($course->instructor)), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }
    public function qa(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }

        $courselectures = Courselectures::where('courses_id',$request->course_id)->pluck('id');

        $questions = Lecturequestions::where('approve',1)->wherein('courselectures_id',$courselectures)->get();
//        dd($questions);

        if($questions && count($questions) > 0){
            return response(apiReturn(LecturequestionsTransformers::transform($questions)), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }
    public function resources(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $course = $this->model->where('id',$request->course_id)->first();
        if($course['courseresources'] && count($course['courseresources']) > 0){
            return response(apiReturn(CourseresourcesTransformers::transform($course['courseresources'])), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }
    public function addReview(Request $request){
        $validator = Validator::make($request->all(), [
            'review' => 'required|max:255',
            'rating' => 'int|max:5',
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $Coursereviews = Coursereviews::create([
            'courses_id' => $request->course_id,
            'user_id' => Auth::guard('api')->user()->id,
            'review' => $request->review,
            'rating' =>  $request->rating,
            'type' => Coursereviews::TYPE_DYNAMIC,
        ]);

        if($Coursereviews){
            return response(apiReturn(trans('website.Your review has been added successfully'), '', ''), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }



    public function addReport(Request $request){
        $validator = Validator::make($request->all(), [
            'report' => 'required|max:255',
            'course_id' => 'required|int|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $Coursereport = Coursereport::create([
            'courses_id' => $request->course_id,
            'user_id' => Auth::guard('api')->user()->id,
            'report' => $request->report,
        ]);

        if($Coursereport){
            return response(apiReturn(trans('website.Your review has been added successfully'), '', ''), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }

    public function notes(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|int|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $coursenotes = Coursenotes::where('courses_id',$request->course_id)
            ->where('user_id',Auth::guard('api')->user()->id)->get();


        if($coursenotes && count($coursenotes) > 0){
            return response(apiReturn(CoursenotesTransformers::transform($coursenotes)), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }

    public function addNotes(Request $request){
        $validator = Validator::make($request->all(), [
            'notes' => 'required|max:255',
            'course_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
        $Coursenotes= Coursenotes::create([
            'courses_id' => $request->course_id,
            'user_id' => Auth::guard('api')->user()->id,
            'notes' => $request->notes,
        ]);

        if($Coursenotes){
            return response(apiReturn(trans('website.Your note has been added successfully'), '', ''), 200);
        }else{
            return response(apiReturn('', '', trans('website.No Data Found')), 401);
        }
    }

}
