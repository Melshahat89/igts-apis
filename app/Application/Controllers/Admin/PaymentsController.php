<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Payments\AddRequestPayments;
use App\Application\Requests\Admin\Payments\UpdateRequestPayments;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PaymentssDataTable;
use App\Application\Model\Payments;
use Yajra\Datatables\Request;
use Alert;

class PaymentsController extends AbstractController
{
    public function __construct(Payments $model)
    {
        parent::__construct($model);
    }

    public function index(PaymentssDataTable $dataTable){
        return $dataTable->render('admin.payments.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.payments.edit' , $id);
    }

     public function store(AddRequestPayments $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/payments');
     }

     public function update($id , UpdateRequestPayments $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.payments.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/payments')->with('sucess' , 'Done Delete payments From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/payments')->with('sucess' , 'Done Delete payments From system');
    }

}
