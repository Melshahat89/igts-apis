<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Partners\AddRequestPartners;
use App\Application\Requests\Admin\Partners\UpdateRequestPartners;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PartnerssDataTable;
use App\Application\Model\Partners;
use Yajra\Datatables\Request;
use Alert;

class PartnersController extends AbstractController
{
    public function __construct(Partners $model)
    {
        parent::__construct($model);
    }

    public function index(PartnerssDataTable $dataTable){
        return $dataTable->render('admin.partners.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.partners.edit' , $id);
    }

     public function store(AddRequestPartners $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/partners');
     }

     public function update($id , UpdateRequestPartners $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.partners.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/partners')->with('sucess' , 'Done Delete partners From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/partners')->with('sucess' , 'Done Delete partners From system');
    }

}
