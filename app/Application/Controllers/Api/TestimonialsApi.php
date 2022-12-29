<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Testimonials;
use App\Application\Transformers\TestimonialsTransformers;
use App\Application\Requests\Website\Testimonials\ApiAddRequestTestimonials;
use App\Application\Requests\Website\Testimonials\ApiUpdateRequestTestimonials;

class TestimonialsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Testimonials $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTestimonials $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTestimonials $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TestimonialsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TestimonialsTransformers::transform($data) + $paginate), $status_code);
    }

}
