<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Eventsdata;
use App\Application\Model\Eventstickets;
use App\Application\Model\User;
use App\Application\Requests\Website\Eventstickets\AddRequestEventstickets;
use App\Application\Requests\Website\Eventstickets\UpdateRequestEventstickets;
use Illuminate\Support\Facades\Auth;

class EventsticketsController extends AbstractController
{

     public function __construct(Eventstickets $model)
     {
        parent::__construct($model);
     }

     public function index(){
        $items = $this->model;

        if(request()->has('from') && request()->get('from') != ''){
            $items = $items->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $items = $items->whereDate('created_at' , '<=' , request()->get('to'));
        }

			if(request()->has("name") && request()->get("name") != ""){
				$items = $items->where("name","=", request()->get("name"));
			}

			if(request()->has("email") && request()->get("email") != ""){
				$items = $items->where("email","=", request()->get("email"));
			}

			if(request()->has("code") && request()->get("code") != ""){
				$items = $items->where("code","=", request()->get("code"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.eventstickets.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.eventstickets.edit' , $id);
     }

     public function store(AddRequestEventstickets $request){

        $user = User::findOrfail(Auth::user()->id);
        $eventsdata = Eventsdata::findOrfail($user->eventsdata->id);

        if ($eventsdata) {
            $request->request->add(['eventsdata_id' => $eventsdata->id]);
            $request->request->add(['code' => $this->generateRandomString(6)]);
        }
        
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect()->back();
     }

     public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //check if exist code
        $code = $this->model->where('code',$randomString)->first();
            if($code){
                $this->generateRandomString($length);
            }

        return $randomString;
    }

     public function update($id , UpdateRequestEventstickets $request){
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.eventstickets.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){

        $user = User::findOrfail(Auth::user()->id);
        $event = $this->model->findOrFail($id);

        if($user->eventsdata->id != $event->eventsdata_id){
            abort('404');
        }


         $this->deleteItem($id , 'eventstickets')->with('sucess' , 'Done Delete Eventstickets From system');
         return redirect()->back();
     }


}
