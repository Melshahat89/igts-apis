<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Events;
use App\Application\Transformers\EventsTransformers;
use App\Application\Requests\Website\Events\ApiAddRequestEvents;
use App\Application\Requests\Website\Events\ApiUpdateRequestEvents;

class EventsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Events $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestEvents $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestEvents $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(EventsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(EventsTransformers::transform($data) + $paginate), $status_code);
    }

}
