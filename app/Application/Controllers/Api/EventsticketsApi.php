<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Eventstickets;
use App\Application\Transformers\EventsticketsTransformers;
use App\Application\Requests\Website\Eventstickets\ApiAddRequestEventstickets;
use App\Application\Requests\Website\Eventstickets\ApiUpdateRequestEventstickets;

class EventsticketsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Eventstickets $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestEventstickets $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestEventstickets $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(EventsticketsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(EventsticketsTransformers::transform($data) + $paginate), $status_code);
    }

}
