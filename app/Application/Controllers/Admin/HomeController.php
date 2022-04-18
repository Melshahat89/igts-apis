<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\HomesDataTable;
use App\Application\Model\Home;
use App\Application\Model\User;
use App\Application\Repository\InterFaces\HomeInterface;
use Yajra\Datatables\Request;
use Alert;
use Illuminate\Support\Facades\Auth;

class HomeController extends AbstractController
{
    protected $homeInterface;
    public function __construct(User $model , HomeInterface $homeInterface)
    {
        
        parent::__construct($model);
        $this->homeInterface = $homeInterface;
    }

    public function index($pages = null , $limit = null){
        $data = $this->homeInterface->getData($pages , $limit);

        $user = Auth::user();
        if ($user->group_id == 9) { // Accounting
            return redirect('/lazyadmin/orders');
        }

        if ($user->group_id == 10) { // Marketing
            return redirect('/lazyadmin/orders');
        }

        if ($user->group_id == 11) { // PR
            return redirect('/lazyadmin/events');
        }

        if ($user->group_id == 12) { // SEO Group
            return redirect('/lazyadmin/courses');
        }

        if ($user->group_id == 13) { // Customer Service
            return redirect('/lazyadmin/quizstudentsstatus');
        }
        
        if ($user->group_id == 14) { // HR
            return redirect('/lazyadmin/careers');
        }
        
        if ($user->group_id == 15) { // Sales
            return redirect('/lazyadmin/orders');
        }

        if ($user->group_id == 16) { // Sales Manager
            return redirect('/lazyadmin/orders');
        }

        return view(layoutPath('index') ,compact('data'));
    }

    public function icons(){
        return view(layoutPath('layout.static.icons'));
    }

    public function apiDocs(){
        return view('vendor.apidoc.index');
    }

    public function fileManager(){
        return view('admin.file-manager.index');
    }

    public function loadAllUsers(){

        if(!isset($_GET['searchTerm'])){
            $results = User::skip(0)->take(10)->get();
        }else{
            $results = User::where('email', 'like', '%' . $_GET['searchTerm'] . '%')->get();
        }

        $data = array();
        foreach($results as $result){
            $data[] = array(
                "id" => $result->id,
                "text" => $result->email
            );
        }
        return json_encode($data);
    }
}
