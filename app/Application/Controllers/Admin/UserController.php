<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\UserDataTable;
use App\Application\Model\Courseenrollment;
use App\Application\Model\Courses;
use App\Application\Model\Promotions;
use App\Application\Model\User;
use App\Application\Repository\InterFaces\UserInterface;
use App\Application\Requests\Admin\User\AddRequestUser;
use App\Application\Requests\Admin\User\UpdateRequestUser;
use Yajra\Datatables\Request;

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
        $data['allCourses'] = Courses::pluck('title','id');
        $data['Allcourseincludes'] = User::where('id' , $id)->with('usersCoursesEnrollments')->first();
        $data['roles_permission'] = $this->userInterface->getPermissionById($id);
        return $this->createOrEdit('admin.user.edit' , $id , $data);
    }

    public function store(AddRequestUser $request){
        $request = $this->userInterface->checkRequest($request);

        if($request->all()['group_id'] == User::TYPE_INSTRUCTOR) {

            $slug = str_replace(' ', '-', $request->all()['name']);

            $request->request->add(['slug'=> $slug]);
        }

         return $this->storeOrUpdate($request , null , 'lazyadmin/user');
    }

    public function update($id , UpdateRequestUser $request){
        $request = $this->userInterface->checkRequest($request);


        if($request->all()['group_id'] == User::TYPE_INSTRUCTOR) {

            $slug = str_replace(' ', '-', $request->all()['name']);

            $request->request->add(['slug'=> $slug]);
        }

        if(isset($request->all()['usersCoursesEnrollments'])){
            $courses = $request->all()['usersCoursesEnrollments'];

            foreach($courses as $course){


                $courseEnrollment = Courseenrollment::where('user_id', $id)->where('courses_id', $course)->first();

                if(!$courseEnrollment){

                    enrollCourse($course, $id);
                }
            }
        }

        
        $item =  $this->storeOrUpdate($request , $id , 'lazyadmin/user');
        return redirect()->back();
    }

    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.user.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/user');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/user')->with('sucess' , 'Done Delete user From system');
    }

}
