<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Talksrelated;
use App\Application\Transformers\TalksrelatedTransformers;
use App\Application\Requests\Website\Talksrelated\ApiAddRequestTalksrelated;
use App\Application\Requests\Website\Talksrelated\ApiUpdateRequestTalksrelated;

class TalksrelatedApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Talksrelated $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTalksrelated $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTalksrelated $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TalksrelatedTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TalksrelatedTransformers::transform($data) + $paginate), $status_code);
    }

}
