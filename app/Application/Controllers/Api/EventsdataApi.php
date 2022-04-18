<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Eventsdata;
use App\Application\Transformers\EventsdataTransformers;
use App\Application\Requests\Website\Eventsdata\ApiAddRequestEventsdata;
use App\Application\Requests\Website\Eventsdata\ApiUpdateRequestEventsdata;

class EventsdataApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Eventsdata $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestEventsdata $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestEventsdata $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(EventsdataTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(EventsdataTransformers::transform($data) + $paginate), $status_code);
    }

}
