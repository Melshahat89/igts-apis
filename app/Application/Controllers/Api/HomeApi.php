<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Homesettings;
use App\Application\Transformers\HomesettingsTransformers;
use App\Application\Requests\Website\Homesettings\ApiAddRequestHomesettings;
use App\Application\Requests\Website\Homesettings\ApiUpdateRequestHomesettings;

class HomeApi extends Controller
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

    public function countersHome(){
        return response(apiReturn([
            'Students' => 1000,
            'Courses' => 500,
            'Hours' => 20000,
            'Comments' => 1200,
        ]), 200);
    }
    public function topSearches(){
        return response(apiReturn([
                'Sports',
                'Courses',
                'Nutrition',
                'تغذية',
                'Obesity',
                'السمنة',
        ]), 200);
    }
    public function quickLinks(){
        return response(apiReturn([
                [
                    'name' => 'Become',
                    'title' => 'an instructor',
                    'link' => 'https://igtsservice.com/joinAsInstructor',
                    'image' => 'https://igtsservice.com/public/website/images/joininstructor3.jpg',
                ],
                [
                    'name' => 'ًWork',
                    'title' => 'with us',
                    'link' => 'https://igtsservice.com/en/careers',
                    'image' => 'https://igtsservice.com/public/uploads/files/medium/41556_1651057576.jpg',
                ],
                [
                    'name' => 'Our',
                    'title' => 'partners',
                    'link' => 'https://igtsservice.com/en/partners',
                    'image' => 'https://igtsservice.com/public/uploads/files/medium/67995_1649936390.jpg',
                ],

        ]), 200);
    }

}
