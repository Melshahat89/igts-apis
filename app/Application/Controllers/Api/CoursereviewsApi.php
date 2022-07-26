<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Coursereviews;
use App\Application\Transformers\CoursereviewsTransformers;
use App\Application\Requests\Website\Coursereviews\ApiAddRequestCoursereviews;
use App\Application\Requests\Website\Coursereviews\ApiUpdateRequestCoursereviews;

class CoursereviewsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Coursereviews $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function index()
    {
        $limit = request()->has('limit') &&  (int) request()->get('limit') != 0 && (int) request()->get('limit') < 30 ? request()->get('limit') : env('PAGINATE');
        $data = $this->model->where('show_app',1)->orderBy('id' , 'desc')->paginate($limit);
        if ($data) {
            return $this->checkLanguageBeforeReturn($data , 200 , $this->paginateArray($data));
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    public function add(ApiAddRequestCoursereviews $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCoursereviews $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
        return response(apiReturn(array_values(CoursereviewsTransformers::transform($data) + $paginate)), $status_code);
    }

}
