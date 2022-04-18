<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Businessdomains;
use App\Application\Requests\Website\Businessdomains\AddRequestBusinessdomains;
use App\Application\Requests\Website\Businessdomains\UpdateRequestBusinessdomains;
use Illuminate\Support\Facades\Auth;

class BusinessdomainsController extends AbstractController
{

     public function __construct(Businessdomains $model)
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

			if(request()->has("domainname") && request()->get("domainname") != ""){
				$items = $items->where("domainname","=", request()->get("domainname"));
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.businessdomains.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.businessdomains.edit' , $id);
     }

     public function store(AddRequestBusinessdomains $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('businessdomains');
     }

     public function update($id , UpdateRequestBusinessdomains $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.businessdomains.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
        $fields = $this->model->findOrFail($id);
        

        // if($fields->businessdata->user->id != Auth::user()->id){
        //     abort('404');
        // }
        $this->deleteItem($id , 'businessdomains')->with('sucess' , 'Done Delete Businessdomains From system');

         return redirect()->back(); 
     }

     public function verify($id){

        $domain = $this->model->findOrFail($id);

        $c = curl_init('https://' . $domain->domainname . '/meduo-verify.html');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt(... other options you want...)

        $html = curl_exec($c);
        if (curl_error($c))
            die(curl_error($c));

        // Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        curl_close($c);
        
        if($status == 200){
            
            if($domain->token == $html){
                $domain->status = 1;
                $domain->save();

                alert()->success('Domain Successfully Verified', trans('website.Success'));
                return redirect()->back();


            }
        }else{

            $file = fopen("meduo-verify.html", "w");
            fwrite($file, $domain->token);
            fclose($file);
    
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="meduo-verify.html"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: meduo-verify.html');
            ob_clean();
            flush();
            readfile('meduo-verify.html');
            exit();
    
            alert()->error("Please make sure that you uploaded the verification file to your domain's main directory", trans('website.Success'));
            return redirect()->back();

        }

        
        
        

     }


}
