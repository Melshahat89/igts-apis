<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\UserDataTable;
use App\Application\Model\User;
use App\Application\Repository\InterFaces\UserInterface;
use App\Application\Requests\Website\User\AddRequestUser;
use App\Application\Requests\Website\User\UpdateRequestUser;
use Yajra\Datatables\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends AbstractController
{
    protected $userInterface;
    protected $middleware;

    public function __construct(User $model , UserInterface $userInterface )
    {
        parent::__construct($model);
        $this->userInterface = $userInterface;
    }

    public function index(UserDataTable $dataTable )
    {
        return $dataTable->render('admin.user.index');
    }

    public function show($id = null){
        $data = $this->userInterface->getPermissions();
        $data['roles_permission'] = $this->userInterface->getPermissionById($id);
        return $this->createOrEdit('admin.user.edit' , $id , $data);
    }

    public function store(AddRequestUser $request){
        $request = $this->userInterface->checkRequest($request);
         return $this->storeOrUpdate($request , null , 'admin/user');
    }

    public function update($id , UpdateRequestUser $request){
        $request = $this->userInterface->checkRequest($request);
        return $this->storeOrUpdate($request , $id , 'admin/user');
    }

    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.user.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/user');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'admin/user')->with('sucess' , 'Done Delete user From system');
    }

    public function verifyUser($token, $returnUrl)
    {

        $returnUrl = str_replace('_','/', $returnUrl);
        $verifyUser = $this->model->where('activation_code', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser;
            if(!$user->verified) {
                $verifyUser->verified = 1;
                $verifyUser->activation_date = now();
                $verifyUser->save();
                alert()->success(trans('website.Your e-mail is verified. You can now login.'), trans('website.Success'));
            }else{
                alert()->success(trans('website.Your e-mail is already verified. You can now login.'), trans('website.Success'));

            }
        }else{
            alert()->success(trans('website.We sent you an activation code. Check your email and click on the link to verify.'), trans('website.Success'));
            return redirect('/');
        }

        Auth::login($user);


        return redirect()->to($returnUrl);
    }

}
