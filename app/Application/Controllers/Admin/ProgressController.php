<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Progress\AddRequestProgress;
use App\Application\Requests\Admin\Progress\UpdateRequestProgress;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\ProgresssDataTable;
use App\Application\Model\Progress;
use Yajra\Datatables\Request;
use Alert;

class ProgressController extends AbstractController
{
    public function __construct(Progress $model)
    {
        parent::__construct($model);
    }

    public function index(ProgresssDataTable $dataTable){
        return $dataTable->render('admin.progress.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.progress.edit' , $id);
    }

     public function store(AddRequestProgress $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('admin/progress');
     }

     public function update($id , UpdateRequestProgress $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.progress.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/progress')->with('sucess' , 'Done Delete progress From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'admin/progress')->with('sucess' , 'Done Delete progress From system');
    }

}
