<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Businessgroups\AddRequestBusinessgroups;
use App\Application\Requests\Admin\Businessgroups\UpdateRequestBusinessgroups;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\BusinessgroupssDataTable;
use App\Application\Model\Businessgroups;
use Yajra\Datatables\Request;
use Alert;

class BusinessgroupsController extends AbstractController
{
    public function __construct(Businessgroups $model)
    {
        parent::__construct($model);
    }

    public function index(BusinessgroupssDataTable $dataTable){
        return $dataTable->render('admin.businessgroups.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.businessgroups.edit' , $id);
    }

     public function store(AddRequestBusinessgroups $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/businessgroups');
     }

     public function update($id , UpdateRequestBusinessgroups $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.businessgroups.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/businessgroups')->with('sucess' , 'Done Delete businessgroups From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/businessgroups')->with('sucess' , 'Done Delete businessgroups From system');
    }

}
