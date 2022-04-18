<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Coursereviews\AddRequestCoursereviews;
use App\Application\Requests\Admin\Coursereviews\UpdateRequestCoursereviews;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CoursereviewssDataTable;
use App\Application\Model\Coursereviews;
use Yajra\Datatables\Request;
use Alert;

class CoursereviewsController extends AbstractController
{
    public function __construct(Coursereviews $model)
    {
        parent::__construct($model);
    }

    public function index(CoursereviewssDataTable $dataTable){
        return $dataTable->render('admin.coursereviews.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.coursereviews.edit' , $id);
    }

     public function store(AddRequestCoursereviews $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/coursereviews');
     }

     public function update($id , UpdateRequestCoursereviews $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.coursereviews.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/coursereviews')->with('sucess' , 'Done Delete coursereviews From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/coursereviews')->with('sucess' , 'Done Delete coursereviews From system');
    }

}
