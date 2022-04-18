<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Careersresponses\AddRequestCareersresponses;
use App\Application\Requests\Admin\Careersresponses\UpdateRequestCareersresponses;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CareersresponsessDataTable;
use App\Application\Model\Careersresponses;
use Yajra\Datatables\Request;
use Alert;

class CareersresponsesController extends AbstractController
{
    public function __construct(Careersresponses $model)
    {
        parent::__construct($model);
    }

    public function index(CareersresponsessDataTable $dataTable){
        return $dataTable->render('admin.careersresponses.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.careersresponses.edit' , $id);
    }

     public function store(AddRequestCareersresponses $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/careersresponses');
     }

     public function update($id , UpdateRequestCareersresponses $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.careersresponses.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/careersresponses')->with('sucess' , 'Done Delete careersresponses From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/careersresponses')->with('sucess' , 'Done Delete careersresponses From system');
    }

}
