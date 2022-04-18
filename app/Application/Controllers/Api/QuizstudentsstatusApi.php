<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Transformers\QuizstudentsstatusTransformers;
use App\Application\Requests\Website\Quizstudentsstatus\ApiAddRequestQuizstudentsstatus;
use App\Application\Requests\Website\Quizstudentsstatus\ApiUpdateRequestQuizstudentsstatus;

class QuizstudentsstatusApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Quizstudentsstatus $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestQuizstudentsstatus $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestQuizstudentsstatus $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(QuizstudentsstatusTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(QuizstudentsstatusTransformers::transform($data) + $paginate), $status_code);
    }

}
