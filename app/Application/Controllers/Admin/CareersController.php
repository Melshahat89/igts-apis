<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Careers\AddRequestCareers;
use App\Application\Requests\Admin\Careers\UpdateRequestCareers;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CareerssDataTable;
use App\Application\Model\Careers;
use Yajra\Datatables\Request;
use Alert;

class CareersController extends AbstractController
{
    public function __construct(Careers $model)
    {
        parent::__construct($model);
    }

    public function index(CareerssDataTable $dataTable){
        return $dataTable->render('admin.careers.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.careers.edit' , $id);
    }

     public function store(AddRequestCareers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/careers');
     }

     public function update($id , UpdateRequestCareers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.careers.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/careers')->with('sucess' , 'Done Delete careers From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/careers')->with('sucess' , 'Done Delete careers From system');
    }

}
