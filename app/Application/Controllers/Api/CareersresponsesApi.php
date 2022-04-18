<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Careersresponses;
use App\Application\Transformers\CareersresponsesTransformers;
use App\Application\Requests\Website\Careersresponses\ApiAddRequestCareersresponses;
use App\Application\Requests\Website\Careersresponses\ApiUpdateRequestCareersresponses;

class CareersresponsesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Careersresponses $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCareersresponses $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCareersresponses $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CareersresponsesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CareersresponsesTransformers::transform($data) + $paginate), $status_code);
    }

}
