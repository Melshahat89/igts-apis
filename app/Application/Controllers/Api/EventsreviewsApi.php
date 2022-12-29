<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Eventsreviews;
use App\Application\Transformers\EventsreviewsTransformers;
use App\Application\Requests\Website\Eventsreviews\ApiAddRequestEventsreviews;
use App\Application\Requests\Website\Eventsreviews\ApiUpdateRequestEventsreviews;

class EventsreviewsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Eventsreviews $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestEventsreviews $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestEventsreviews $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(EventsreviewsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(EventsreviewsTransformers::transform($data) + $paginate), $status_code);
    }

}
