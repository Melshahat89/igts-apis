<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Slider;
use App\Application\Transformers\SliderTransformers;
use App\Application\Requests\Website\Slider\ApiAddRequestSlider;
use App\Application\Requests\Website\Slider\ApiUpdateRequestSlider;

class SliderApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Slider $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestSlider $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestSlider $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(SliderTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(SliderTransformers::transform($data) + $paginate), $status_code);
    }

}
