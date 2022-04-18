<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Talksreviews\AddRequestTalksreviews;
use App\Application\Requests\Admin\Talksreviews\UpdateRequestTalksreviews;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TalksreviewssDataTable;
use App\Application\Model\Talksreviews;
use Yajra\Datatables\Request;
use Alert;

class TalksreviewsController extends AbstractController
{
    public function __construct(Talksreviews $model)
    {
        parent::__construct($model);
    }

    public function index(TalksreviewssDataTable $dataTable){
        return $dataTable->render('admin.talksreviews.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.talksreviews.edit' , $id);
    }

     public function store(AddRequestTalksreviews $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/talksreviews');
     }

     public function update($id , UpdateRequestTalksreviews $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.talksreviews.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/talksreviews')->with('sucess' , 'Done Delete talksreviews From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/talksreviews')->with('sucess' , 'Done Delete talksreviews From system');
    }

}
