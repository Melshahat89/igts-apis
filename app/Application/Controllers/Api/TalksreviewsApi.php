<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Talksreviews;
use App\Application\Transformers\TalksreviewsTransformers;
use App\Application\Requests\Website\Talksreviews\ApiAddRequestTalksreviews;
use App\Application\Requests\Website\Talksreviews\ApiUpdateRequestTalksreviews;

class TalksreviewsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Talksreviews $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTalksreviews $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTalksreviews $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TalksreviewsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TalksreviewsTransformers::transform($data) + $paginate), $status_code);
    }

}
