<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use App\Application\Model\Businesscourses;
use App\Application\Model\Businessdata;
use App\Application\Model\Businessgroups;
use App\Application\Model\Categories;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Quizstudentsstatus;
use App\Application\Model\Tickets;
use App\Application\Model\Ticketsreplay;
use App\Application\Model\User;
use App\Application\Requests\Admin\Businessgroups\UpdateRequestBusinessgroups;
use App\Application\Requests\Website\Businessdata\AddRequestBusinessdata;
use App\Application\Requests\Website\Businessdata\UpdateRequestBusinessdata;
use App\Application\Requests\Website\Businessdomains\AddRequestBusinessdomains;
use App\Application\Requests\Website\Businessgroups\AddRequestBusinessgroups;
use App\Application\Requests\Website\Businessgroups\UpdateRequestBusinessgroups as BusinessgroupsUpdateRequestBusinessgroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Application\Controllers\Traits\QRCodeTrait;
use App\Application\Model\Businessgroupsusers;
use App\Application\Model\Businessinputfields;
use App\Application\Model\Businessinputfieldsresponses;
use App\Application\Model\Businessuserspendingemails;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class BusinessdataController extends AbstractController
{

    public function __construct(Businessdata $model)
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

        if (request()->has("name") && request()->get("name") != "") {
            $items = $items->where("name", "like", "%" . request()->get("name") . "%");
        }

        if (request()->has("discount_type") && request()->get("discount_type") != "") {
            $items = $items->where("discount_type", "=", request()->get("discount_type"));
        }

        if (request()->has("discount_value") && request()->get("discount_value") != "") {
            $items = $items->where("discount_value", "=", request()->get("discount_value"));
        }

        if (request()->has("automatically_license") && request()->get("automatically_license") != "") {
            $items = $items->where("automatically_license", "=", request()->get("automatically_license"));
        }

        if (request()->has("status") && request()->get("status") != "") {
            $items = $items->where("status", "=", request()->get("status"));
        }

        $items = $items->paginate(env('PAGINATE'));
        return view('website.businessdata.index', compact('items'));
    }

    public function show($id = null)
    {
        return $this->createOrEdit('website.businessdata.edit', $id);
    }

    public function store(AddRequestBusinessdata $request)
    {
        $item = $this->storeOrUpdate($request, null, true);
        return redirect('businessdata');
    }

    public function update($id, UpdateRequestBusinessdata $request)
    {

        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

    }

    public function getById($id)
    {
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('website.businessdata.show', $id, ['fields' => $fields]);
    }

    public function destroy($id)
    {

        return $this->deleteItem($id, 'businessdata')->with('sucess', 'Done Delete Businessdata From system');
    }
    public function home()
    {
        $this->data['title'] = '545';
        return view('website.business.home', $this->data);
    }
    public function settings(Request $request)
    {

        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        if (request()->post()) {
            if (request()->post('automatically_license')) {
                $businessdata->automatically_license = 1;
            } else {
                $businessdata->automatically_license = 0;
            }
            $businessdata->save();
        }

        $this->data['businessdata'] = $businessdata;
        $this->data['businesscourses'] =  Businesscourses::where('businessdata_id', $businessdata->id)->get();;
        $this->data['domains'] = $businessdata->businessdomains;

        $this->data['inputFields'] = Businessinputfields::all();
        return view('website.business.settings', $this->data);
    }

    public function editInputFields($id) {


        $this->data['inputField'] =  Businessinputfields::findOrFail($id);

        return view('website.business.editinputfields', $this->data);

    }

    public function updateInputFields(Request $request) {

        $inputname = $request->request->all()['name'];
        $mandatory = (isset($request->request->all()['mandatory'])) ? 1 : 0;
        $inputfield_id = $request->request->all()['inputfield_id'];

        $inputField = Businessinputfields::findOrFail($inputfield_id);
        $inputField->field_name = $inputname;
        $inputField->mandatory = $mandatory;
        $inputField->save();

        return redirect()->to('/business/settings');

    }

    public function deleteInputFields($id){

        $inputField = Businessinputfields::findOrFail($id);

        $inputField->delete();

        return redirect()->to('/business/settings');


    }


    public function addDomian(AddRequestBusinessdomains $request)
    {
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);

        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        // Add New Request
        $request->request->add(['businessdata_id' => $businessdata->id]);
        $request->request->add(['token' => $token]);
       // $request->request->add(['status' => 1]);

        if (checkdnsrr($request->domainname)) {
            $request->request->add(['domainname' => $request->domainname]);
        } else {
            alert()->error("Domain not found", "Error");
            return redirect()->back();
        }


        $item = app('App\Application\Controllers\Website\BusinessdomainsController')->storeOrUpdate($request, null, true);
        return redirect()->back();
    }

    public function users()
    {
        $this->data['title'] = '545';
        return view('website.business.users', $this->data);
    }

    public function groups($id = NULL)
    {
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        $this->data['Groups'] = Businessgroups::whereNull('parent_id')->where('businessdata_id', $businessdata->id)->get();
        $this->data['allGroups'] = Businessgroups::where('businessdata_id', $businessdata->id)->get();
        $this->data['categories'] = Categories::all();
        $this->data['courses'] = Courses::all();
        $this->data['businessCourses'] = $businessdata->businesscoursescourses;
        $this->data['businessCoursesArr'] = $businessdata->businesscoursescourses->pluck('title_lang', 'id')->toArray();
        if($id != NULL){

            $group = Businessgroups::findOrFail($id);
            $this->data['group'] = $group;
            $this->data['groupCourses'] = $group->businessgroupscourses;


        }

        $this->data['businessData'] = $businessdata;
        return view('website.business.groups', $this->data);
    }

    public function editGroup($id){

        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        $group = Businessgroups::where('id', $id)->where('businessdata_id', $businessdata->id)->get();

        $this->data['group'] = $group[0];
        $this->data['groupCourses'] = $group[0]->businessgroupscourses;
        $this->data['groupCoursesArr'] = $group[0]->businessgroupscourses->pluck('title_lang', 'id')->toArray();

        $this->data['businessCourses'] = $businessdata->businesscoursescourses;
        $this->data['businessCoursesArr'] = $businessdata->businesscoursescourses->pluck('title_lang', 'id')->toArray();

        return view('website.business.editgroup', $this->data);

    }

    public function updateGroup($id, BusinessgroupsUpdateRequestBusinessgroups $request){


        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        // Add New Request
        $request->request->add(['businessdata_id' => $businessdata->id]);


        $item = app('App\Application\Controllers\Website\BusinessgroupsController')->storeOrUpdate($request, $id, true);

        return redirect()->to('/business/groups');


    }
    
    public function addGroup(AddRequestBusinessgroups $request)
    {
        
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        // Add New Request
        $request->request->add(['businessdata_id' => $businessdata->id]);

        $item = app('App\Application\Controllers\Website\BusinessgroupsController')->storeOrUpdate($request, null, true);

        return redirect()->back();
    }

 

    public function usersInformation()
    {
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        // dd($user->businessdata);
        $this->data['Groups'] = Businessgroups::whereNull('parent_id')->where('businessdata_id', $businessdata->id)->get();

        $this->data['users'] = User::where('businessdata_id', $businessdata->id)->get();
        

        return view('website.business.usersInformation', $this->data);
    }

    public function inviteBulkUsers(Request $request)
    {


         $businessdata_id = $request->request->all()['businessId'];
         $group_id = $request->request->all()['group_id'];


        if (request()->has('emails') && request()->post('emails') != '') {
            $emails = request()->post('emails');
            $myArray = str_replace(' ', '', explode(',', $emails));

            foreach ($myArray as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $list = list($user, $domain) = explode('@', $email);
                    //if (checkdnsrr($domain)) {
                        // Send Email
                       // Mail::to($email)->send(new \App\Mail\invitation());
                        
                        $user = User::where('email', $email)->get();
                        if(count($user) > 0 && $user){
                            $user[0]->businessdata_id = $businessdata_id;
                            $user[0]->save();

                            if($group_id != null){
                            $groupUser = new Businessgroupsusers();
                            $groupUser->businessgroups_id = $group_id;
                            $groupUser->user_id = $user[0]->id;

                            $groupUser->save();

                            }
                        }else{


                            //User Not Found
                            // Send Email
                           // Mail::to($email)->send(new \App\Mail\invitation());
                           $pendingUser = Businessuserspendingemails::where('email', $email)->first();

                           if(!$pendingUser){

                            $pendingUser = new Businessuserspendingemails;
                            $pendingUser->email = $email;
                            $pendingUser->businessdata_id = $businessdata_id;
    
                            if($group_id){
                                $pendingUser->group_id = $group_id;
                            }
                            $pendingUser->save();
    
                       }else{
                            if($group_id){
                                $pendingUser->group_id = $group_id;
                            }else{
                                $pendingUser->group_id = NULL;
                            }
    
                            
                            $pendingUser->save();
                       }

                        }
                       

                   // }
                }
            }
        }

        if (request()->has('emailsfile')) {
            Global $emailsArr;
            $emailsArr = array();
            try {
                Excel::load($request->emailsfile, function ($reader) {
                    
                    global $emailsArr;
                    foreach ($reader->toArray() as $key => $email) {
                        if (filter_var($email['emails'], FILTER_VALIDATE_EMAIL)) {
                            $list = list($user, $domain) = explode('@', $email['emails']);
                            //if (checkdnsrr($domain)) {

                                array_push($emailsArr, $email['emails']);

                                // Send Email
                               // Mail::to($email['emails'])->send(new \App\Mail\invitation());                                

                           // }
                        }
                    }
                });

                foreach($emailsArr as $email){

                    $user = User::where('email', $email)->get();
                    
                    if(count($user) > 0){
                        $user[0]->businessdata_id = $businessdata_id;
                        $user[0]->save();

                        if($group_id != null){
                            $groupUser = new Businessgroupsusers();
                            $groupUser->businessgroups_id = $group_id;
                            $groupUser->user_id = $user[0]->id;
                            $groupUser->save();
                            
                        }
                }else{


                    //User Not Found
                    // Send Email
                   // Mail::to($email)->send(new \App\Mail\invitation());
                   $pendingUser = Businessuserspendingemails::where('email', $email)->first();
                   if(!$pendingUser){

                        $pendingUser = new Businessuserspendingemails;
                        $pendingUser->email = $email;
                        $pendingUser->businessdata_id = $businessdata_id;

                        if($group_id){
                            $pendingUser->group_id = $group_id;
                        }
                        $pendingUser->save();

                   }else{
                        if($group_id){
                            $pendingUser->group_id = $group_id;
                        }else{
                            $pendingUser->group_id = NULL;
                        }

                        $pendingUser->save();
                   }
                    

                }

                }

                alert()->success(trans('businessdata.The invitations were sent successfully'), trans('website.Success'));

            } catch (\Exception $e) {
                alert()->error($e->getMessage(), "Error");
            }

        }

        return redirect()->back();
    }

    public function inviteUsers()
    {
        $user = User::findOrfail(Auth::user()->id);
        $this->data['businessdata'] = $businessdata = Businessdata::findOrfail($user->businessdata->id);
        $this->data['Groups'] = Businessgroups::whereNull('parent_id')->where('businessdata_id', $businessdata->id)->get();

        $qr = new QRCodeTrait();
        $qr->url(concatenateLangToUrl('business/invite/' . $businessdata->id .'/'));
        
        $this->data['initQr'] = $qr->qrCode(500);

        return view('website.business.inviteUsers', $this->data);
    }

    public function generateQrCodeAjax(){

        $url = urldecode(substr(url()->full(), strpos(url()->full(), "=") + 1));

        $qr = new QRCodeTrait();
        $qr->url($url);

        $code = $qr->qrCode(500);
        
        return response()->json(['success'=>true , 'code'=>$code], 200);


    }

    public function enrollments()
    {
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        $this->data['Enrollments'] = Courseenrollment::
            select(DB::raw('Count(courses_id) as Count'), 'courses_id')
            ->with('courses')
            ->whereHas('user', function ($query) use ($businessdata) {
                return $query->where('businessdata_id', '=', $businessdata->id);
            })

            ->groupBy('courses_id')
            ->get();

        $this->data['EnrollmentsLog'] = Courseenrollment::
            whereHas('user', function ($query) use ($businessdata) {
            return $query->where('businessdata_id', '=', $businessdata->id);
        })

            ->get();


        $this->data['groups'] = Businessgroups::all();

        return view('website.business.enrollments', $this->data);
    }

    public function userAdoptionFunnel()
    {
      $user = User::findOrfail(Auth::user()->id);
      $businessdata = Businessdata::findOrfail($user->businessdata->id);

      $this->data['businessdata'] = $businessdata;

        return view('website.business.userAdoptionFunnel', $this->data);
    }

    public function coursesInsight()
    {
      $user = User::findOrfail(Auth::user()->id);
      $businessdata = Businessdata::findOrfail($user->businessdata->id);
      $businesscourses = Businesscourses::where('businessdata_id',$businessdata->id)->pluck('id');

      
    //   $this->data['Enrollments'] = Courseenrollment::
    //   select(DB::raw('Count(courses_id) as Count'), 'courses_id')
    //   ->whereIn('courses_id', Businesscourses::select('id'))

    //   ->where('status',1)
    //   ->groupBy('courses_id')
    //   ->get();

    $this->data['Enrollments'] = Courseenrollment::select(DB::raw('Count(courses_id) as Count'), 'courses_id')->whereIn('courses_id', Businesscourses::select('courses_id'))->whereIn('user_id', User::select('id')->where('businessdata_id', $businessdata->id))->get();

   //   dd($this->data['Enrollments']);


      
        // $this->data['Enrollments'] = Courses::
        // select('*')
        // ->whereHas(['businesscourses' => function($q) use ($businessdata){
        //     $q->select('*');
        //     $q->where('businessdata_id', '=', $businessdata->id);
        // }]) 
        // ->whereHas(['courseenrollment' => function($q) {
        //     $q->select('*');
        //     $q->where('status', '=', 1);
        // }])
        
    
        // ->get();

    //   dd($this->data['Enrollments']);

    //dd(Courses::find(43)->businesscourseenrollments);
       //   $this->data['Enrollments'] = Courseenrollment::whereIn('user_id', User::select('id')->where('businessdata_id', $businessdata->id)->first())->get();

      $this->data['businessdata'] = $businessdata;

      return view('website.business.coursesInsight', $this->data);
    }

    public function usersInsight()
    {
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        $this->data['businessdata'] = $businessdata;
        $this->data['Enrollments'] = Courseenrollment::select(DB::raw('Count(user_id) as Count'), 'user_id')
        ->with('user')
        ->whereHas('user', function ($query) use ($businessdata) {
           return $query->where('businessdata_id', '=', $businessdata->id);
        })
        
        ->groupBy('user_id')
        ->get();


        return view('website.business.usersInsight', $this->data);
    }
    public function tickets()
    {

        $tickets = Tickets::where('user_id',Auth::user()->id)->get();

        $this->data['tickets'] = $tickets;
    
        return view('website.business.tickets', $this->data);
    }
    public function replays($ticket_id)
    {
        $tickets = Tickets::where('user_id',Auth::user()->id)->findorfail($ticket_id);
        $Ticketsreplay = Ticketsreplay::where('tickets_id',$ticket_id)->get();
        $this->data['Ticketsreplay'] = $Ticketsreplay;

    
        return view('website.business.ticketsreplays', $this->data);
    }
    public function userActivity()
    {
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);

        $this->data['businessdata'] = $businessdata;

        $this->data['Users'] = User::where('businessdata_id', $businessdata->id)->whereHas('courseenrollment')
        ->get();

        return view('website.business.userActivity', $this->data);
    }

    public function userActivityUser($id)
    {
        $user = User::findOrfail(Auth::user()->id);
        $businessdata = Businessdata::findOrfail($user->businessdata->id);
        $this->data['businessdata'] = $businessdata;
        $this->data['FinishedExams'] = Quizstudentsstatus::where('user_id',$id)->where('status',4)->get();

        $this->data['User'] = User::where('businessdata_id', $businessdata->id)->findOrfail($id);
        return view('website.business.userActivityUser', $this->data);
    }

    public function sendCertificateOfAppreciation($user_id) {

    }

    public function addInputFields(Request $request) {
        $fieldName = $request->request->all()['fieldName'];
        $mandatory = 0;

        if(isset($request->request->all()['mandatory'])){
            $mandatory = ($request->request->all()['mandatory'] == "on") ? 1 : 0;
        }
    
        $businessInputField = new Businessinputfields();
        $businessInputField->businessdata_id = $request->request->all()['businessdata_id'];
        $businessInputField->mandatory = $mandatory;
        $businessInputField->field_name = $fieldName;

        $businessInputField->save();

    }


    public function storeBusinessinputfieldsresponses(Request $request){


        foreach($request->all() as $key => $input) {
            
            if($key != "_token") { 

                $businessInputFields = Businessinputfields::where('field_name', $key)->first();

                $businessInputFieldsResponse = Businessinputfieldsresponses::where('businessinputfields_id', $businessInputFields->id)->where('user_id', Auth::user()->id)->first();

                if($businessInputFieldsResponse) {

                    $businessInputFieldsResponse->answer = $input;
                    $businessInputFieldsResponse->save();

                }else{

                    $businessInputFieldsResponse = new Businessinputfieldsresponses();
                    $businessInputFieldsResponse->businessinputfields_id = $businessInputFields->id;
                    $businessInputFieldsResponse->user_id = Auth::user()->id;
                    $businessInputFieldsResponse->answer = $input;
                    $businessInputFieldsResponse->save();

                }

            }
            

        }

        return redirect()->back();


    }
}
