<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Lecturequestionsanswers\AddRequestLecturequestionsanswers;
use App\Application\Requests\Admin\Lecturequestionsanswers\UpdateRequestLecturequestionsanswers;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\LecturequestionsanswerssDataTable;
use App\Application\Model\Lecturequestionsanswers;
use Yajra\Datatables\Request;
use Alert;

class LecturequestionsanswersController extends AbstractController
{
    public function __construct(Lecturequestionsanswers $model)
    {
        parent::__construct($model);
    }

    public function index(LecturequestionsanswerssDataTable $dataTable){
        return $dataTable->render('admin.lecturequestionsanswers.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.lecturequestionsanswers.edit' , $id);
    }

     public function store(AddRequestLecturequestionsanswers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/lecturequestionsanswers');
     }

     public function update($id , UpdateRequestLecturequestionsanswers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.lecturequestionsanswers.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/lecturequestionsanswers')->with('sucess' , 'Done Delete lecturequestionsanswers From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/lecturequestionsanswers')->with('sucess' , 'Done Delete lecturequestionsanswers From system');
    }

}
