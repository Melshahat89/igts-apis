<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Businessdomains\AddRequestBusinessdomains;
use App\Application\Requests\Admin\Businessdomains\UpdateRequestBusinessdomains;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\BusinessdomainssDataTable;
use App\Application\Model\Businessdomains;
use Yajra\Datatables\Request;
use Alert;

class BusinessdomainsController extends AbstractController
{
    public function __construct(Businessdomains $model)
    {
        parent::__construct($model);
    }

    public function index(BusinessdomainssDataTable $dataTable){
        return $dataTable->render('admin.businessdomains.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.businessdomains.edit' , $id);
    }

     public function store(AddRequestBusinessdomains $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/businessdomains');
     }

     public function update($id , UpdateRequestBusinessdomains $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.businessdomains.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/businessdomains')->with('sucess' , 'Done Delete businessdomains From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/businessdomains')->with('sucess' , 'Done Delete businessdomains From system');
    }

}
