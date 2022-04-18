<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Ordersposition\AddRequestOrdersposition;
use App\Application\Requests\Admin\Ordersposition\UpdateRequestOrdersposition;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\OrderspositionsDataTable;
use App\Application\Model\Ordersposition;
use Yajra\Datatables\Request;
use Alert;

class OrderspositionController extends AbstractController
{
    public function __construct(Ordersposition $model)
    {
        parent::__construct($model);
    }

    public function index(OrderspositionsDataTable $dataTable){
        return $dataTable->render('admin.ordersposition.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.ordersposition.edit' , $id);
    }

     public function store(AddRequestOrdersposition $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/ordersposition');
     }

     public function update($id , UpdateRequestOrdersposition $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.ordersposition.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/ordersposition')->with('sucess' , 'Done Delete ordersposition From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/ordersposition')->with('sucess' , 'Done Delete ordersposition From system');
    }

}
