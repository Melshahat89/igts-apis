<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Quizquestionschoice;
use App\Application\Transformers\QuizquestionschoiceTransformers;
use App\Application\Requests\Website\Quizquestionschoice\ApiAddRequestQuizquestionschoice;
use App\Application\Requests\Website\Quizquestionschoice\ApiUpdateRequestQuizquestionschoice;

class QuizquestionschoiceApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Quizquestionschoice $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestQuizquestionschoice $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestQuizquestionschoice $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(QuizquestionschoiceTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(QuizquestionschoiceTransformers::transform($data) + $paginate), $status_code);
    }

}
