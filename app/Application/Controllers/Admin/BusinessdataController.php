<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Businessdata\AddRequestBusinessdata;
use App\Application\Requests\Admin\Businessdata\UpdateRequestBusinessdata;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\BusinessdatasDataTable;
use App\Application\Model\Businessdata;
use Yajra\Datatables\Request;
use Alert;

class BusinessdataController extends AbstractController
{
    public function __construct(Businessdata $model)
    {
        parent::__construct($model);
    }

    public function index(BusinessdatasDataTable $dataTable){
        return $dataTable->render('admin.businessdata.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.businessdata.edit' , $id);
    }

     public function store(AddRequestBusinessdata $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/businessdata');
     }

     public function update($id , UpdateRequestBusinessdata $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.businessdata.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/businessdata')->with('sucess' , 'Done Delete businessdata From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/businessdata')->with('sucess' , 'Done Delete businessdata From system');
    }

}
