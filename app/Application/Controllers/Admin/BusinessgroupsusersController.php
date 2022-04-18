<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Businessgroupsusers\AddRequestBusinessgroupsusers;
use App\Application\Requests\Admin\Businessgroupsusers\UpdateRequestBusinessgroupsusers;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\BusinessgroupsuserssDataTable;
use App\Application\Model\Businessgroupsusers;
use Yajra\Datatables\Request;
use Alert;

class BusinessgroupsusersController extends AbstractController
{
    public function __construct(Businessgroupsusers $model)
    {
        parent::__construct($model);
    }

    public function index(BusinessgroupsuserssDataTable $dataTable){
        return $dataTable->render('admin.businessgroupsusers.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.businessgroupsusers.edit' , $id);
    }

     public function store(AddRequestBusinessgroupsusers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/businessgroupsusers');
     }

     public function update($id , UpdateRequestBusinessgroupsusers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.businessgroupsusers.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/businessgroupsusers')->with('sucess' , 'Done Delete businessgroupsusers From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/businessgroupsusers')->with('sucess' , 'Done Delete businessgroupsusers From system');
    }

}
