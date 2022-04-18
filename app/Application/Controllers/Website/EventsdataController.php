<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Events;
use App\Application\Model\Eventsdata;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\Transactions;
use App\Application\Model\User;
use App\Application\Requests\Website\Eventsdata\AddRequestEventsdata;
use App\Application\Requests\Website\Eventsdata\UpdateRequestEventsdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventsdataController extends AbstractController
{
    private $user ;

     public function __construct(Eventsdata $model)
     {
        
        parent::__construct($model);

        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();

            if(!Auth::user()->eventsdata){
                $eventsdata = new Eventsdata();
                $eventsdata->user_id = Auth::user()->id;
                $eventsdata->name = Auth::user()->name;
                $eventsdata->email = Auth::user()->email;
                $eventsdata->status = 1;
                $eventsdata->save();
            }
            
            return $next($request);
        });
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
				$items = $items->where("name","like", "%".request()->get("name")."%");
			}

			if(request()->has("email") && request()->get("email") != ""){
				$items = $items->where("email","=", request()->get("email"));
			}

			if(request()->has("website") && request()->get("website") != ""){
				$items = $items->where("website","=", request()->get("website"));
			}

			if(request()->has("about") && request()->get("about") != ""){
				$items = $items->where("about","like", "%".request()->get("about")."%");
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.eventsdata.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.eventsdata.edit' , $id);
     }

     public function store(AddRequestEventsdata $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('eventsdata');
     }

     public function update($id , UpdateRequestEventsdata $request){
        $user = User::findOrfail(Auth::user()->id);
        $eventsdata = Eventsdata::findOrfail($user->eventsdata->id);

        if($user->eventsdata->id != $id){
            abort('404');
        }
        
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.eventsdata.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'eventsdata')->with('sucess' , 'Done Delete Eventsdata From system');
     }

     public function home(){
        $this->data['title'] = '545';
        return view('website.events.home', $this->data);
    }

    public function settings(){
        $user = User::findOrfail(Auth::user()->id);
        $eventsdata = Eventsdata::findOrfail($user->eventsdata->id);
        $this->data['item'] = $eventsdata;
        return view('website.events.settings', $this->data);
    }
    public function addEvent($id = null){
        $user = User::findOrfail(Auth::user()->id);
        $eventsdata = Eventsdata::findOrfail($user->eventsdata->id);
        if($id){
            $Events = Events::findOrfail($id);
            if($user->eventsdata->id != $Events->eventsdata_id){
                abort('404');
            }
            $this->data['item'] = $Events;
        }
        $this->data['title'] = '';
        return view('website.events.addEvent', $this->data);
    }

    public function all(){
        $user = User::findOrfail(Auth::user()->id);
        $eventsdata = Eventsdata::findOrfail($user->eventsdata->id);
        $events = Events::where('eventsdata_id',$user->eventsdata->id)->paginate(env('PAGINATE'));
        $this->data['items'] = $events;
        return view('website.events.all', $this->data);
    }

    public function addTicket($id = null){
        $user = User::findOrfail(Auth::user()->id);
        if($id){
            $Eventstickets = Eventstickets::findOrfail($id);
            if($user->eventsdata->id != $Eventstickets->eventsdata_id){
                abort('404');
            }
            $this->data['item'] = $Eventstickets;
        }
        $this->data['title'] = '';
        return view('website.events.addTicket', $this->data);
    }

    public function allTicket(){
        $user = User::findOrfail(Auth::user()->id);
        $Eventstickets = Eventstickets::where('eventsdata_id',$user->eventsdata->id)->paginate(env('PAGINATE'));
        $this->data['items'] = $Eventstickets;
        return view('website.events.allTicket', $this->data);
    }

    public function enrollments(){
        $user = User::findOrfail(Auth::user()->id);
        $Events = Events::where('eventsdata_id',$user->eventsdata->id)->get();
        // $Eventsenrollment = Eventsenrollment::whereIn('events_id',$Events)->paginate(env('PAGINATE'));
        $Eventsenrollment = Eventsenrollment::whereIn('events_id',$Events)->get();
        
        $this->data['items'] = $Eventsenrollment;
        $this->data['Events'] = $Events;

        return view('website.events.enrollments', $this->data);
    }
    public function revenue(){
        $user = User::findOrfail(Auth::user()->id);
        $Events = Events::where('eventsdata_id',$user->eventsdata->id)->get();
        $userEvents = Events::where('eventsdata_id',$user->eventsdata->id)->get();
        $Transactions = Transactions::whereIn('events_id',$Events)->where('user_id',Auth::user()->id)->where('type',Transactions::EVENTDATA)->paginate(env('PAGINATE'));

        $arr = array();
        foreach($userEvents as $event){
            $test = Transactions::where('events_id', $event->id)->where('user_id',Auth::user()->id)->where('type',Transactions::EVENTDATA)->sum('amount');

            array_push($arr, ["event" => $event, "amount" => $test, "instructor_per" => $event->instructor_per]);
        }
        $this->data['items'] = $arr;
        $this->data['Events'] = $Events;
        return view('website.events.revenue', $this->data);
    }

}
