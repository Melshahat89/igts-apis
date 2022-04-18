<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Promotionactive\AddRequestPromotionactive;
use App\Application\Requests\Admin\Promotionactive\UpdateRequestPromotionactive;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PromotionactivesDataTable;
use App\Application\Model\Promotionactive;
use Yajra\Datatables\Request;
use Alert;

class PromotionactiveController extends AbstractController
{
    public function __construct(Promotionactive $model)
    {
        parent::__construct($model);
    }

    public function index(PromotionactivesDataTable $dataTable){
        return $dataTable->render('admin.promotionactive.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.promotionactive.edit' , $id);
    }

     public function store(AddRequestPromotionactive $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/promotionactive');
     }

     public function update($id , UpdateRequestPromotionactive $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.promotionactive.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/promotionactive')->with('sucess' , 'Done Delete promotionactive From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/promotionactive')->with('sucess' , 'Done Delete promotionactive From system');
    }

}
