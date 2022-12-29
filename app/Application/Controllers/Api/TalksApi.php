<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Talks;
use App\Application\Transformers\TalksTransformers;
use App\Application\Requests\Website\Talks\ApiAddRequestTalks;
use App\Application\Requests\Website\Talks\ApiUpdateRequestTalks;

class TalksApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Talks $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTalks $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTalks $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TalksTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TalksTransformers::transform($data) + $paginate), $status_code);
    }

}
