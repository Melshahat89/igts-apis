<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Courserelated\AddRequestCourserelated;
use App\Application\Requests\Admin\Courserelated\UpdateRequestCourserelated;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CourserelatedsDataTable;
use App\Application\Model\Courserelated;
use Yajra\Datatables\Request;
use Alert;

class CourserelatedController extends AbstractController
{
    public function __construct(Courserelated $model)
    {
        parent::__construct($model);
    }

    public function index(CourserelatedsDataTable $dataTable){
        return $dataTable->render('admin.courserelated.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.courserelated.edit' , $id);
    }

     public function store(AddRequestCourserelated $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/courserelated');
     }

     public function update($id , UpdateRequestCourserelated $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.courserelated.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/courserelated')->with('sucess' , 'Done Delete courserelated From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/courserelated')->with('sucess' , 'Done Delete courserelated From system');
    }

}
