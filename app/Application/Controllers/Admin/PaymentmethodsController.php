<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use Yajra\Datatables\Request;
use Alert;
use App\Application\DataTables\PaymentmethodsDataTable;
use App\Application\Model\PaymentMethods;
use App\Application\Requests\Admin\Paymentmethods\AddRequestPaymentmethods;
use App\Application\Requests\Admin\Paymentmethods\UpdateRequestPaymentmethods;

class PaymentmethodsController extends AbstractController {

    public function __construct(PaymentMethods $model)
    {
        parent::__construct($model);
    }

    public function index(PaymentmethodsDataTable $dataTable){
        return $dataTable->render('admin.paymentmethods.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.paymentmethods.edit' , $id);
    }

     public function store(AddRequestPaymentmethods $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/paymentmethods');
     }

     public function update($id , UpdateRequestPaymentmethods $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.paymentmethods.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/paymentmethods')->with('sucess' , 'Done Delete partners From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/paymentmethods')->with('sucess' , 'Done Delete partners From system');
    }

}