<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Social;
use App\Application\Transformers\SocialTransformers;
use App\Application\Requests\Website\Social\ApiAddRequestSocial;
use App\Application\Requests\Website\Social\ApiUpdateRequestSocial;

class SocialApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Social $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestSocial $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestSocial $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(SocialTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(SocialTransformers::transform($data) + $paginate), $status_code);
    }

}
