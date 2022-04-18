<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Lecturequestions;
use App\Application\Transformers\LecturequestionsTransformers;
use App\Application\Requests\Website\Lecturequestions\ApiAddRequestLecturequestions;
use App\Application\Requests\Website\Lecturequestions\ApiUpdateRequestLecturequestions;

class LecturequestionsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Lecturequestions $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestLecturequestions $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestLecturequestions $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(LecturequestionsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(LecturequestionsTransformers::transform($data) + $paginate), $status_code);
    }

}
