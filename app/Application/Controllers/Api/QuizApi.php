<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Quiz;
use App\Application\Transformers\QuizTransformers;
use App\Application\Requests\Website\Quiz\ApiAddRequestQuiz;
use App\Application\Requests\Website\Quiz\ApiUpdateRequestQuiz;

class QuizApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Quiz $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestQuiz $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestQuiz $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(QuizTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(QuizTransformers::transform($data) + $paginate), $status_code);
    }

}
