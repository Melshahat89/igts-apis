<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Homesettings;
use App\Application\Transformers\HomesettingsTransformers;
use App\Application\Requests\Website\Homesettings\ApiAddRequestHomesettings;
use App\Application\Requests\Website\Homesettings\ApiUpdateRequestHomesettings;

class HomesettingsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Homesettings $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestHomesettings $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestHomesettings $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(HomesettingsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(HomesettingsTransformers::transform($data) + $paginate), $status_code);
    }

}
