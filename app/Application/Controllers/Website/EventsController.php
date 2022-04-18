<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use App\Application\Model\Categories;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Eventsdata;
use App\Application\Model\Eventsenrollment;
use App\Application\Model\Eventstickets;
use App\Application\Model\Homesettings;
use App\Application\Model\Orders;
use App\Application\Model\Ordersposition;
use App\Application\Model\Payments;
use App\Application\Model\User;
use App\Application\Requests\Website\Events\AddRequestEvents;
use App\Application\Requests\Website\Events\UpdateRequestEvents;
use App\Mail\EventConfirm;
use Composer\EventDispatcher\Event;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EventsController extends AbstractController
{

    public function __construct(Events $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $items = $this->model;

        if (request()->has('from') && request()->get('from') != '') {
            $items = $items->whereDate('created_at', '>=', request()->get('from'));
        }

        if (request()->has('to') && request()->get('to') != '') {
            $items = $items->whereDate('created_at', '<=', request()->get('to'));
        }

        if (request()->has("title") && request()->get("title") != "") {
            $items = $items->where("title", "like", "%" . request()->get("title") . "%");
        }

        if (request()->has("description") && request()->get("description") != "") {
            $items = $items->where("description", "like", "%" . request()->get("description") . "%");
        }

        if (request()->has("is_free") && request()->get("is_free") != "") {
            $items = $items->where("is_free", "=", request()->get("is_free"));
        }

        if (request()->has("price_egp") && request()->get("price_egp") != "") {
            $items = $items->where("price_egp", "=", request()->get("price_egp"));
        }

        if (request()->has("price_usd") && request()->get("price_usd") != "") {
            $items = $items->where("price_usd", "=", request()->get("price_usd"));
        }

        if (request()->has("type") && request()->get("type") != "") {
            $items = $items->where("type", "=", request()->get("type"));
        }

        if (request()->has("status") && request()->get("status") != "") {
            $items = $items->where("status", "=", request()->get("status"));
        }

        if (request()->has("location") && request()->get("location") != "") {
            $items = $items->where("location", "=", request()->get("location"));
        }

        if (request()->has("live_link") && request()->get("live_link") != "") {
            $items = $items->where("live_link", "=", request()->get("live_link"));
        }

        if (request()->has("recorded_link") && request()->get("recorded_link") != "") {
            $items = $items->where("recorded_link", "=", request()->get("recorded_link"));
        }

        $items = $items->paginate(env('PAGINATE'));
        return view('website.events.index', compact('items'));
    }

    public function show($id = null)
    {
        return $this->createOrEdit('website.events.edit', $id);
    }

    public function store(AddRequestEvents $request)
    {
        $user = User::findOrfail(Auth::user()->id);
        $eventsdata = Eventsdata::findOrfail($user->eventsdata->id);

        if ($eventsdata) {
            $request->request->add(['eventsdata_id' => $eventsdata->id]);
        }

        $item = $this->storeOrUpdate($request, null, true);
        return redirect()->back();
    }

    public function update($id, UpdateRequestEvents $request)
    {
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();
    }

    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('website.events.show', $id, ['fields' => $fields]);
    }

    public function destroy($id)
    {
        $user = User::findOrfail(Auth::user()->id);
        $event = $this->model->findOrFail($id);

        if ($user->eventsdata->id != $event->eventsdata_id) {
            abort('404');
        }

        $this->deleteItem($id, 'events')->with('sucess', 'Done Delete Events From system');
        return redirect()->back();
    }

    public function category($slug=null)
    {
        //$items = $this->model->where('status', 1);

        $items = Courses::where('type', 5);
        $category = null;

        Session::put('slug', $slug);
        $this->data['slug'] = '';
        $this->data['key'] = '';


        if ($slug) {

            $this->data['slug'] = $slug;

            $category = Categories::where('slug',$slug)->first();
            $categoryId = (isset($category->id))?$category->id:'';
            $items = $items->whereHas('categories', function ($query) {
                return  $query->where('slug', '=', Session::get('slug'));
            });

            $category = Categories::where('slug', request()->get("category"))->first();
            $this->data['category'] = $category;
        }

        if (isset($category)) {
            
            // Most Viewed talks
            //$mostViewedPerCategory = Events::where('status', 1)->where('categories_id', $category->id)->orderBy('visits', 'DESC')->limit(10)->get();
            $mostViewedPerCategory = Courses::where('categories_id', $category->id)->where('soon', 0)->where('type', Courses::TYPE_WEBINAR)->orderBy('visits', 'DESC')->limit(10)->get();

        } else {
            // Most Viewed talks
            //$mostViewedPerCategory = Events::where('status', 1)->orderBy('visits', 'DESC')->limit(10)->get();
            $mostViewedPerCategory = Courses::where('soon', 0)->where('type', Courses::TYPE_WEBINAR)->orderBy('visits', 'DESC')->limit(10)->get();

        }


        // $items = $items->where('status', 1)->get();

        if (request()->has('rating') && request()->get('rating') != '') {
            $this->data['rating'] = $_GET['rating'];
            //dd($this->data['rating']);
            $items = $items->filter(function ($item) {
                if ($item->EventRating > ((int) $this->data['rating'] - 1) and $item->EventRating <= (int) $this->data['rating']) {
                    return $item;
                }   
            });
        } else {
            $this->data['rating'] = '';
        }


        if (request()->has('key') && request()->get('key') != '') {
            // $items = $items->where("title", "like", "%" . request()->get("key") . "%");

            $items = $items->where(function ($query) {
                $query->where("title", "like", "%" . request()->get("key") . "%")
                ;
            });

            $this->data['key'] = $_GET['key'];
        }

        
        
        $items = $items->where('published', 1)->get();
        
        $items = initPaginate($items, 8);



        // $items = $items->paginate(env('PAGINATE'));
        $this->data['homesettings'] = Homesettings::find(1);

        $this->data['mostViewedPerCategory'] = $mostViewedPerCategory;

        $this->data['Events'] = $items;

        $this->data['tabsWidth'] = tabsContainerItemsWidth();
        $this->data['category'] = $category;

        return view('website.events.category', $this->data);
    }
    public function page($id)
    {
        $event = $this->model->findOrFail($id);

        Events::recordVisit($event);
        $this->data['model'] = $event;
        $this->data['relatedEvents'] = Events::where('status', 1)->where('categories_id', $event->categories_id)->limit(10)->get();

        $this->data['enrolled'] = Events::isEnrolledEvent($event->id);
        $this->data['shoppingCart'] = Events::inShoppingCart($event->id);

        
        $eventStatus = getEventStatus($event);


       
        if(Auth::check()){
            
            $user = User::find(Auth::user()->id);

        }
        
        

        if($this->data['enrolled']){

            if($eventStatus == "passed" && !Events::hasEventCertificate($event->id)){
               
                Events::generateCertificate($event, $user->first_name);
                
            }
            
        
        }
          
        


    
    

        return view('website.events.page', $this->data);
    }


    public function confirm($id){

        $event = $this->model->findOrFail($id);
        
        $enrolled = Events::isEnrolledEvent($id);
        $this->data['model'] = $event;

        if($enrolled){
            return view('website.events.confirmation', $this->data);
        }else{
            return redirect('/');
        }
        
    }


    public function addEventToCart($event_id)
    {

        $event = Events::findOrfail($event_id);

        //Check the existing of pending order for this user
        $order = Orders::where('user_id', Auth::user()->id)->where('status', Orders::STATUS_PENDING)->first();
        if (!$order) {
            $order = new Orders();
            $order->status = Orders::STATUS_PENDING;
            $order->user_id = Auth::user()->id;
            $order->save();
        }

        // Ceck if the order position found:
        $orderPosition = Ordersposition::where('events_id', $event->id)->where('orders_id', $order->id)->orderBy('id', 'DESC')->first();


        if (!$orderPosition) {
            //Save the item in the cart
            $orderPosition = new Ordersposition();
            $orderPosition->amount = $event->OriginalPrice;
            $orderPosition->quantity = 1;
            $orderPosition->unit_price = $event->OriginalPrice;
            $orderPosition->orders_id = $order->id;
            $orderPosition->events_id = $event->id;
            $orderPosition->user_id = Auth::user()->id;
            $orderPosition->type = Ordersposition::TYPE_Event;
            $orderPosition->save();
        }

        // To set Kiosk id Null
        $order->kiosk_id = null;
        $order->save();

        alert()->success(trans('website.Successfully added to cart'), trans('website.Success'));
        return redirect('/cart');
    }




    public function enrollEventNow($eventID)
    {

        $event = Events::findOrfail($eventID);
        $price = $event->OriginalPrice;




        if(isset($_GET['full_name'])){

        $user = User::where('id', Auth::user()->id)->get();

        $user[0]->first_name = $_GET['full_name'];
        $user[0]->save();

        }

        if ($event->is_free == 1) {


            $enrolled = Events::isEnrolledEvent($event->id);

            if (!$enrolled) {
                $enroll = new Eventsenrollment();
                $enroll->user_id = Auth::user()->id;
                $enroll->events_id = $event->id;
                $enroll->status = 1;
                //End date



                $Addational_time = 3600;
                $date = date('Y-m-d H:i:s');
                $yesterday = date('Y-m-d H:i:s', strtotime($date . "-4 hours"));
                $enroll->start_time = $yesterday;
                $date = strtotime($date);
                $date = strtotime("+" . $Addational_time . " day", $date);
                $date = date('Y-m-d H:i:s', $date);
                $enddate = date('Y-m-d H:i:s', strtotime($date . "+4 hours"));
                $enroll->end_time = $enddate;
                $enroll->save();

                
            }

            return redirect("/events/confirmation/" . $event->id);


            // $freeOrder = new Orders();
            // $freeOrder->status = Orders::STATUS_SUCCEEDED;
            // $freeOrder->user_id = Auth::user()->id;
            // $currency = getCurrency();

            // if ($freeOrder->save()) {
            //     //save the payement
            //     $payment = new Payments();
            //     $payment->operation = Payments::OPERATION_DEPOSIT;
            //     $payment->amount = 0;
            //     $payment->currency_id = ($currency == 'EGP') ? 34 : 2;
            //     $payment->user_id = Auth::user()->id;
            //     $payment->receiver_id = 1;
            //     $payment->status = Payments::STATUS_SUCCEEDED;
            //     $payment->orders_id = $freeOrder->id;

            //     if ($payment->save()) {
            //         //Save the item in the cart
            //         $orderPosition = new Ordersposition();
            //         $orderPosition->amount =  0;
            //         $orderPosition->quantity = 1;
            //         $orderPosition->unit_price = 0;
            //         $orderPosition->orders_id = $freeOrder->id;
            //         $orderPosition->events_id = $event->id;
            //         $orderPosition->user_id = Auth::user()->id;
            //         $orderPosition->type = Ordersposition::TYPE_Event;
            //         $orderPosition->save();

            //         $enrolled = Events::isEnrolledEvent($event->id);

            //         if (!$enrolled) {
            //             $enroll = new Eventsenrollment();
            //             $enroll->user_id = Auth::user()->id;
            //             $enroll->events_id = $event->id;
            //             $enroll->status = 1;
            //             //End date

            //             $Addational_time = 3600;
            //             $date = date('Y-m-d H:i:s');
            //             $yesterday = date('Y-m-d H:i:s', strtotime($date . "-4 hours"));
            //             $enroll->start_time = $yesterday;
            //             $date = strtotime($date);
            //             $date = strtotime("+" . $Addational_time . " day", $date);
            //             $date = date('Y-m-d H:i:s', $date);
            //             $enddate = date('Y-m-d H:i:s', strtotime($date . "+4 hours"));
            //             $enroll->end_time = $enddate;
            //             $enroll->save();

            //             //Generate Ticket
            //             $ticket = new Eventstickets();
            //             $ticket->name = Auth::user()->fullname_lang;
            //             $ticket->email = Auth::user()->email;
            //             $ticket->code = $this->generateRandomString(8);
            //             $ticket->user_id = Auth::user()->id;
            //             $ticket->events_id = $event->id;
            //             $ticket->eventsdata_id = $event->eventsdata->id;
            //             $ticket->save();
            //         }else{
            //             $ticket = Eventstickets::where('user_id',Auth::user()->id)->where('events_id',$event->id)->first();
            //         }


            //         alert()->success(trans('website.Thank you! Your request was successfully submitted!'), trans('website.Success'));

            //         // Send order email to the customer
            //         Mail::to(Auth::user()->email)->send(new EventConfirm($freeOrder, Auth::user(), getShoppingCartCost(),$ticket));

            //         return redirect("/events/view/" . $event->id);
            //     }
            // }
        }
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //check if exist code
        $code = Eventstickets::where('code',$randomString)->first();
            if($code){
                $this->generateRandomString($length);
            }

        return $randomString;
    }
}
