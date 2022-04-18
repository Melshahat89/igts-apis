<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Quizstudentsanswers;
use App\Application\Transformers\QuizstudentsanswersTransformers;
use App\Application\Requests\Website\Quizstudentsanswers\ApiAddRequestQuizstudentsanswers;
use App\Application\Requests\Website\Quizstudentsanswers\ApiUpdateRequestQuizstudentsanswers;

class QuizstudentsanswersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Quizstudentsanswers $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestQuizstudentsanswers $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestQuizstudentsanswers $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(QuizstudentsanswersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(QuizstudentsanswersTransformers::transform($data) + $paginate), $status_code);
    }

}
