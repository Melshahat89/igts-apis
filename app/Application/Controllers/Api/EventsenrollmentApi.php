<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Eventsenrollment;
use App\Application\Transformers\EventsenrollmentTransformers;
use App\Application\Requests\Website\Eventsenrollment\ApiAddRequestEventsenrollment;
use App\Application\Requests\Website\Eventsenrollment\ApiUpdateRequestEventsenrollment;

class EventsenrollmentApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Eventsenrollment $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestEventsenrollment $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestEventsenrollment $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(EventsenrollmentTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(EventsenrollmentTransformers::transform($data) + $paginate), $status_code);
    }

}
