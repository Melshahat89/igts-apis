<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Lecturequestions\AddRequestLecturequestions;
use App\Application\Requests\Admin\Lecturequestions\UpdateRequestLecturequestions;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\LecturequestionssDataTable;
use App\Application\Model\Lecturequestions;
use Yajra\Datatables\Request;
use Alert;

class LecturequestionsController extends AbstractController
{
    public function __construct(Lecturequestions $model)
    {
        parent::__construct($model);
    }

    public function index(LecturequestionssDataTable $dataTable){
        return $dataTable->render('admin.lecturequestions.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.lecturequestions.edit' , $id);
    }

     public function store(AddRequestLecturequestions $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/lecturequestions');
     }

     public function update($id , UpdateRequestLecturequestions $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.lecturequestions.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/lecturequestions')->with('sucess' , 'Done Delete lecturequestions From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/lecturequestions')->with('sucess' , 'Done Delete lecturequestions From system');
    }

}
