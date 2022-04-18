<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Talksrelated\AddRequestTalksrelated;
use App\Application\Requests\Admin\Talksrelated\UpdateRequestTalksrelated;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TalksrelatedsDataTable;
use App\Application\Model\Talksrelated;
use Yajra\Datatables\Request;
use Alert;

class TalksrelatedController extends AbstractController
{
    public function __construct(Talksrelated $model)
    {
        parent::__construct($model);
    }

    public function index(TalksrelatedsDataTable $dataTable){
        return $dataTable->render('admin.talksrelated.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.talksrelated.edit' , $id);
    }

     public function store(AddRequestTalksrelated $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/talksrelated');
     }

     public function update($id , UpdateRequestTalksrelated $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.talksrelated.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/talksrelated')->with('sucess' , 'Done Delete talksrelated From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/talksrelated')->with('sucess' , 'Done Delete talksrelated From system');
    }

}
