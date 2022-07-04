<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\BecomeInstructor;
use App\Application\Transformers\BecomeInstructorTransformers;
use App\Application\Requests\Website\BecomeInstructor\ApiAddRequestBecomeInstructor;
use App\Application\Requests\Website\BecomeInstructor\ApiUpdateRequestBecomeInstructor;

class BecomeInstructorApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(BecomeInstructor $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestBecomeInstructor $validation){
         return $this->addItem($validation);
    }
    public function careers(ApiAddRequestBecomeInstructor $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestBecomeInstructor $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
        return response(apiReturn(BecomeInstructorTransformers::transform($data) + $paginate), $status_code);
    }

}
