<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Categories;
use App\Application\Transformers\CategoriesTransformers;
use App\Application\Requests\Website\Categories\ApiAddRequestCategories;
use App\Application\Requests\Website\Categories\ApiUpdateRequestCategories;

class CategoriesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Categories $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCategories $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCategories $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(CategoriesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(CategoriesTransformers::transform($data) + $paginate), $status_code);
    }

}
