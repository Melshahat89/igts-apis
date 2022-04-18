<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Lecturequestionsanswers;
use App\Application\Transformers\LecturequestionsanswersTransformers;
use App\Application\Requests\Website\Lecturequestionsanswers\ApiAddRequestLecturequestionsanswers;
use App\Application\Requests\Website\Lecturequestionsanswers\ApiUpdateRequestLecturequestionsanswers;

class LecturequestionsanswersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Lecturequestionsanswers $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestLecturequestionsanswers $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestLecturequestionsanswers $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(LecturequestionsanswersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(LecturequestionsanswersTransformers::transform($data) + $paginate), $status_code);
    }

}
