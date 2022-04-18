<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Careers;
use App\Application\Transformers\CareersTransformers;
use App\Application\Requests\Website\Careers\ApiAddRequestCareers;
use App\Application\Requests\Website\Careers\ApiUpdateRequestCareers;

class CareersApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Careers $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCareers $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCareers $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CareersTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CareersTransformers::transform($data) + $paginate), $status_code);
    }

}
