<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\BecomeInstructor\AddRequestBecomeInstructor;
use App\Application\Requests\Admin\BecomeInstructor\UpdateRequestBecomeInstructor;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\BecomeInstructorsDataTable;
use App\Application\Model\BecomeInstructor;
use Yajra\Datatables\Request;
use Alert;

class BecomeInstructorController extends AbstractController
{
    public function __construct(BecomeInstructor $model)
    {
        parent::__construct($model);
    }

    public function index(BecomeInstructorsDataTable $dataTable){
        return $dataTable->render('admin.becomeinstructor.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.becomeinstructor.edit' , $id);
    }

     public function store(AddRequestBecomeInstructor $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('admin/becomeinstructor');
     }

     public function update($id , UpdateRequestBecomeInstructor $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.becomeinstructor.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/becomeinstructor')->with('sucess' , 'Done Delete becomeinstructor From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'admin/becomeinstructor')->with('sucess' , 'Done Delete becomeinstructor From system');
    }

}
