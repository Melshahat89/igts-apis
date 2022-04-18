<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Quizquestions;
use App\Application\Transformers\QuizquestionsTransformers;
use App\Application\Requests\Website\Quizquestions\ApiAddRequestQuizquestions;
use App\Application\Requests\Website\Quizquestions\ApiUpdateRequestQuizquestions;

class QuizquestionsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Quizquestions $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestQuizquestions $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestQuizquestions $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(QuizquestionsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(QuizquestionsTransformers::transform($data) + $paginate), $status_code);
    }

}
