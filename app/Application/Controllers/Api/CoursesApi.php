<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Categories;
use App\Application\Model\Courses;
use App\Application\Transformers\CoursesTransformers;
use App\Application\Requests\Website\Courses\ApiAddRequestCourses;
use App\Application\Requests\Website\Courses\ApiUpdateRequestCourses;
use Illuminate\Support\Facades\Auth;



class CoursesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Courses $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestCourses $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestCourses $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {

//        dd(request()->hasHeader("Accept-Language"));
       if (request()->headers->has('lang') && request()->headers->get('lang') == 'ar') {

           return response(apiReturn(array_values(CoursesTransformers::transformAr($data) + $paginate)), $status_code);
        }
//        dd(22);
        return response(apiReturn(array_values(CoursesTransformers::transform($data) + $paginate)), $status_code);
    }

    public function index()
    {
//        dd(auth('api')->check());
        $limit = request()->has('limit') &&  (int) request()->get('limit') != 0 && (int) request()->get('limit') < 30 ? request()->get('limit') : env('PAGINATE');
        $data = $this->model;
        if (request()->has("search_keys") && request()->get("search_keys") != "") {
            $data = $data->where("search_keys", "like", "%" . request()->get("search_keys") . "%");
        }

        if (request()->has("type") && request()->get("type") != "") {
            $data = $data->where("type", "=", request()->get("type"));
        }

        $data = $data->where('published', 1)->orderBy('id' , 'desc')->paginate($limit);

        if ($data AND count($data) > 0) {
            return response(apiReturn(['items' => array_values(CoursesTransformers::transform($data))] + $this->paginateArray($data)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

}
