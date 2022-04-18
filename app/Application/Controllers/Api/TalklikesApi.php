<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Talklikes;
use App\Application\Transformers\TalklikesTransformers;
use App\Application\Requests\Website\Talklikes\ApiAddRequestTalklikes;
use App\Application\Requests\Website\Talklikes\ApiUpdateRequestTalklikes;

class TalklikesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Talklikes $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTalklikes $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTalklikes $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TalklikesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TalklikesTransformers::transform($data) + $paginate), $status_code);
    }

}
