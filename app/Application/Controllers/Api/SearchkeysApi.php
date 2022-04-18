<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Searchkeys;
use App\Application\Transformers\SearchkeysTransformers;
use App\Application\Requests\Website\Searchkeys\ApiAddRequestSearchkeys;
use App\Application\Requests\Website\Searchkeys\ApiUpdateRequestSearchkeys;

class SearchkeysApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Searchkeys $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestSearchkeys $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestSearchkeys $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(SearchkeysTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(SearchkeysTransformers::transform($data) + $paginate), $status_code);
    }

}
