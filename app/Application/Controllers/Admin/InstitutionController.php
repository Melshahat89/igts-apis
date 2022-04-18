<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Institution\AddRequestInstitution;
use App\Application\Requests\Admin\Institution\UpdateRequestInstitution;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\InstitutionsDataTable;
use App\Application\Model\Institution;
use Yajra\Datatables\Request;
use Alert;

class InstitutionController extends AbstractController
{
    public function __construct(Institution $model)
    {
        parent::__construct($model);
    }

    public function index(InstitutionsDataTable $dataTable){
        return $dataTable->render('admin.institution.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.institution.edit' , $id);
    }

     public function store(AddRequestInstitution $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/institution');
     }

     public function update($id , UpdateRequestInstitution $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.institution.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/institution')->with('sucess' , 'Done Delete institution From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/institution')->with('sucess' , 'Done Delete institution From system');
    }

}
