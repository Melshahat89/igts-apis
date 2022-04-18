<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Courseincludes\AddRequestCourseincludes;
use App\Application\Requests\Admin\Courseincludes\UpdateRequestCourseincludes;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CourseincludessDataTable;
use App\Application\Model\Courseincludes;
use Yajra\Datatables\Request;
use Alert;

class CourseincludesController extends AbstractController
{
    public function __construct(Courseincludes $model)
    {
        parent::__construct($model);
    }

    public function index(CourseincludessDataTable $dataTable){
        return $dataTable->render('admin.courseincludes.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.courseincludes.edit' , $id);
    }

     public function store(AddRequestCourseincludes $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/courseincludes');
     }

     public function update($id , UpdateRequestCourseincludes $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.courseincludes.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/courseincludes')->with('sucess' , 'Done Delete courseincludes From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/courseincludes')->with('sucess' , 'Done Delete courseincludes From system');
    }

}
