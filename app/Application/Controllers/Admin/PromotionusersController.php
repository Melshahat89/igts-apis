<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Promotionusers\AddRequestPromotionusers;
use App\Application\Requests\Admin\Promotionusers\UpdateRequestPromotionusers;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PromotionuserssDataTable;
use App\Application\Model\Promotionusers;
use Yajra\Datatables\Request;
use Alert;

class PromotionusersController extends AbstractController
{
    public function __construct(Promotionusers $model)
    {
        parent::__construct($model);
    }

    public function index(PromotionuserssDataTable $dataTable){
        return $dataTable->render('admin.promotionusers.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.promotionusers.edit' , $id);
    }

     public function store(AddRequestPromotionusers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/promotionusers');
     }

     public function update($id , UpdateRequestPromotionusers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.promotionusers.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/promotionusers')->with('sucess' , 'Done Delete promotionusers From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/promotionusers')->with('sucess' , 'Done Delete promotionusers From system');
    }

}
