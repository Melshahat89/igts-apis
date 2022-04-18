<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Faq\AddRequestFaq;
use App\Application\Requests\Admin\Faq\UpdateRequestFaq;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\FaqsDataTable;
use App\Application\Model\Faq;
use Yajra\Datatables\Request;
use Alert;

class FaqController extends AbstractController
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    public function index(FaqsDataTable $dataTable){
        return $dataTable->render('admin.faq.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.faq.edit' , $id);
    }

     public function store(AddRequestFaq $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/faq');
     }

     public function update($id , UpdateRequestFaq $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.faq.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/faq')->with('sucess' , 'Done Delete faq From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/faq')->with('sucess' , 'Done Delete faq From system');
    }

}
