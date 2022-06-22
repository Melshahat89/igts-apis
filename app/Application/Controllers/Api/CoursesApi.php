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
use App\Application\Model\Quiz;
use App\Application\Model\Quizstudentsanswers;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Transformers\CourselecturesTransformers;
use App\Application\Transformers\CourselectureTransformers;
use App\Application\Transformers\CoursenotesTransformers;
use App\Application\Transformers\CourseresourcesTransformers;
use App\Application\Transformers\CoursesectionsTransformers;
use App\Application\Transformers\CoursesTransformers;
use App\Application\Requests\Website\Courses\ApiAddRequestCourses;
use App\Application\Requests\Website\Courses\ApiUpdateRequestCourses;
use App\Application\Transformers\CourseTransformers;
use App\Application\Transformers\InstructorsTransformers;
use App\Application\Transformers\LecturequestionsTransformers;
use App\Application\Transformers\QuizquestionsTransformers;
use App\Application\Transformers\QuizTransformers;
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
    public function lecture(Request $request){
        $validator = Validator::make($request->all(), [
            'lecture_id' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }
//        $course = $this->model->where('id',$request->course_id)->first();
        $lecture = Courselectures::where('id',$request->lecture_id)->first();

        if($lecture){
            return response(apiReturn(CourselectureTransformers::transform($lecture)), 200);
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


    public function exam(Request $request){
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required|integer|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()], '', ['error'=>$validator->errors()]), 401);
        }

        $exam = Quiz::where('id',$request->exam_id)->first();

        $enrolled = Courses::isEnrolledCourse($exam['courses']['id']);

        if ((!$enrolled)) {
            return response(apiReturn('', '', 'You don\'t have permission to access this page'), 403);
        }

        $studentExam = Quizstudentsstatus::where('user_id',Auth::guard('api')->user()->id)->where('quiz_id',$exam->id)->orderBy('created_at', 'desc')->first();



        if($studentExam){
            // Exam time-out //////////////////////////
            $done = FALSE;

            if($studentExam->end_time == 0){
                $current = time();
                $start = $studentExam->start_time;

                $spentTime = $current - $start;
                $quizTime = $studentExam->quiz->time * 60;

                $done = ( ($quizTime - $spentTime) > 0 ) ? FALSE : TRUE;
            }

            if($done == TRUE){
                $studentExam->status = 4;
                $studentExam->end_time = time();

                // Pass or fail/////////////////////////////////////
                $quizTotalScore = $exam->quizSum;
                //                    $studentScore = $exam->currentStudentMark;
                $studentScore = $studentExam->CurrentStudentMark;

                $percentage = round( (( $studentScore * 100 ) / $quizTotalScore),1 ) ;
                $examPassPercentage = $exam->pass_percentage;
                $studentExam->passed = ( $percentage >= $examPassPercentage) ? 1 : 0;
                $studentExam->save();

                return response(apiReturn($exam->pass_percentage, '', ''), 200);
            }

            // Start New Exam if the admin anabled the student to retry again
            if($studentExam->exam_anytime == 1){

                $studentExam = new Quizstudentsstatus();
                $studentExam->user_id = Auth::guard('api')->user()->id;
                $studentExam->quiz_id = $exam->id;
                $studentExam->start_time = time();
                $studentExam->status = 1;
                $studentExam->save();
            }
            /////////////////////////////////////////////////////////////////////

            // if the student finishs this exam, display him/her the results:
            if($studentExam->status == 4){
                return response(apiReturn($exam->pass_percentage, '', ''), 200);
            }

        }else{
            $studentExam = new Quizstudentsstatus();
            $studentExam->user_id = Auth::guard('api')->user()->id;
            $studentExam->quiz_id = $exam->id;
            $studentExam->start_time = time();
            $studentExam->status = 1;
            $studentExam->save();
        }
        return response(apiReturn(QuizTransformers::transform($exam), '', ''), 200);

    }

    public function examResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required|integer|max:255',
            'question' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error' => $validator->errors()], '', ['error' => $validator->errors()]), 401);
        }

        $exam = Quiz::where('id',$request->exam_id)->first();
        $enrolled = Courses::isEnrolledCourse($exam['courses']['id']);

        if ((!$enrolled)) {
            return response(apiReturn('', '', 'You don\'t have permission to access this page'), 403);
        }

        $studentExam = Quizstudentsstatus::where('user_id',Auth::guard('api')->user()->id)->where('quiz_id',$exam->id)->orderBy('created_at', 'desc')->first();

        //Save the student answers:
        foreach ($exam->quizquestions as $question) {
            if(isset($request->question[$question->id])){
                $questionSelcetedAnswer = (int)$request->question[$question->id];
                //   var_dump($questionSelcetedAnswer);die;
                $quizAnswers = new Quizstudentsanswers();

                $quizAnswers->user_id = Auth::guard('api')->user()->id;
                $quizAnswers->quiz_id = $exam->id;
                $quizAnswers->quizquestions_id = $question->id;
                $quizAnswers->quizstudentsstatus_id = $studentExam->id;

                if(is_int($questionSelcetedAnswer) && $questionSelcetedAnswer > 0){
                    $quizAnswers->quizquestionschoice_id = $questionSelcetedAnswer;
                    $quizAnswers->answered = 1;
                }else{
                    $quizAnswers->quizquestionschoice_id = NULL;
                    $quizAnswers->answered = 0;
                    $quizAnswers->mark = 0;
                }
                $quizAnswers->save();
                //Check if the answer is correct or not:
                if($quizAnswers->quizquestionschoice->is_correct == 1){
                    $quizAnswers->is_correct = 1;
                    $quizAnswers->mark = $question->mark;
                    $quizAnswers->save();
                }

            }else{
                //                        die("out");
            }


        }

        if($studentExam){
            // Exam time-out //////////////////////////
            $done = FALSE;

            if($studentExam->end_time == 0){
                $current = time();
                $start = $studentExam->start_time;

                $spentTime = $current - $start;
                $quizTime = $studentExam->quiz->time * 60;

                $done = ( ($quizTime - $spentTime) > 0 ) ? FALSE : TRUE;
            }

            if($done == TRUE){
                $studentExam->status = 4;
                $studentExam->end_time = time();

                // Pass or fail/////////////////////////////////////
                $quizTotalScore = $exam->quizSum;
                //                    $studentScore = $exam->currentStudentMark;
                $studentScore = $studentExam->CurrentStudentMark;

                $percentage = round( (( $studentScore * 100 ) / $quizTotalScore),1 ) ;
                $examPassPercentage = $exam->pass_percentage;
                $studentExam->passed = ( $percentage >= $examPassPercentage) ? 1 : 0;
                $studentExam->save();

                return redirect("/courses/examResults/" . $slug);
            }

            // Start New Exam if the admin anabled the student to retry again
            if($studentExam->exam_anytime == 1){

                $studentExam = new Quizstudentsstatus();
                $studentExam->user_id = auth()->user()->id;
                $studentExam->quiz_id = $exam->id;
                $studentExam->start_time = time();
                $studentExam->status = 1;
                $studentExam->save();
            }
            /////////////////////////////////////////////////////////////////////
            ///
            $quizTotalScore = $exam->quizSum;
            $studentScore = Quiz::currentStudentMark($studentExam->id);
            $percentage = round( (( $studentScore * 100 ) / $quizTotalScore), 1);
            $examPassPercentage = $exam->pass_percentage;
            $isPassed = ( $percentage >= $examPassPercentage) ? 1 : 0;
            $totalQuestions = $exam->quizQuestionsCount;



            //$answeredQuestions = $exam->currentStudentAnswerdQuestionsCount( array( 'condition'=>'student_exam_instant_id=:studentExamInstantId', 'params'=>array( ':studentExamInstantId'=>$studentExam->id ) ) );
            $answeredQuestions = $studentExam->studentAnswerdQuestionsCount;
            $CorrectansweredQuestions = $studentExam->studentAnswerdCorrectQuestionsCount;


//            dd($studentExam->isPassed);
            // if the student finishs this exam, display him/her the results:
            if($studentExam->status == 4){
                return response(apiReturn(
                    [
//                        'exam' => $exam,
                        'isPassed' => $isPassed,
                        'totalQuestions' => $totalQuestions,
                        'answeredQuestions' => $answeredQuestions,
                        'correctansweredQuestions' => $CorrectansweredQuestions,
                        'percentage' => $percentage,
                        'examPassPercentage' => $examPassPercentage,
                        'certificate' => $studentExam->certificate,
                    ], '', ''), 200);
            }

            return response(apiReturn(
                [
//                    'exam' => $exam,
                    'isPassed' => $isPassed,
                    'totalQuestions' => $totalQuestions,
                    'answeredQuestions' => $answeredQuestions,
                    'correctansweredQuestions' => $CorrectansweredQuestions,
                    'percentage' => $percentage,
                    'examPassPercentage' => $examPassPercentage,
                    'certificate' => $studentExam->certificate,
                ], '', ''), 200);

        }




    }

}
