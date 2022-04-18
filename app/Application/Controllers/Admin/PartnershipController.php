<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Partnership\AddRequestPartnership;
use App\Application\Requests\Admin\Partnership\UpdateRequestPartnership;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PartnershipsDataTable;
use App\Application\Model\Partnership;
use Yajra\Datatables\Request;
use Alert;

class PartnershipController extends AbstractController
{
    public function __construct(Partnership $model)
    {
        parent::__construct($model);
    }

    public function index(PartnershipsDataTable $dataTable){
        return $dataTable->render('admin.partnership.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.partnership.edit' , $id);
    }

     public function store(AddRequestPartnership $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/partnership');
     }

     public function update($id , UpdateRequestPartnership $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.partnership.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/partnership')->with('sucess' , 'Done Delete partnership From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/partnership')->with('sucess' , 'Done Delete partnership From system');
    }

}
