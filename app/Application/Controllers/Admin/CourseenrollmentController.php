<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Courseenrollment\AddRequestCourseenrollment;
use App\Application\Requests\Admin\Courseenrollment\UpdateRequestCourseenrollment;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CourseenrollmentsDataTable;
use App\Application\Model\Courseenrollment;
use Yajra\Datatables\Request;
use Alert;

class CourseenrollmentController extends AbstractController
{
    public function __construct(Courseenrollment $model)
    {
        parent::__construct($model);
    }

    public function index(CourseenrollmentsDataTable $dataTable){
        return $dataTable->render('admin.courseenrollment.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.courseenrollment.edit' , $id);
    }

     public function store(AddRequestCourseenrollment $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/courseenrollment');
     }

     public function update($id , UpdateRequestCourseenrollment $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.courseenrollment.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/courseenrollment')->with('sucess' , 'Done Delete courseenrollment From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/courseenrollment')->with('sucess' , 'Done Delete courseenrollment From system');
    }

}
