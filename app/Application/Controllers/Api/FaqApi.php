<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Faq;
use App\Application\Transformers\FaqTransformers;
use App\Application\Requests\Website\Faq\ApiAddRequestFaq;
use App\Application\Requests\Website\Faq\ApiUpdateRequestFaq;

class FaqApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Faq $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestFaq $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestFaq $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(FaqTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(FaqTransformers::transform($data) + $paginate), $status_code);
    }

}
