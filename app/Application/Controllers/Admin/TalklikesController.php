<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Talklikes\AddRequestTalklikes;
use App\Application\Requests\Admin\Talklikes\UpdateRequestTalklikes;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TalklikessDataTable;
use App\Application\Model\Talklikes;
use Yajra\Datatables\Request;
use Alert;

class TalklikesController extends AbstractController
{
    public function __construct(Talklikes $model)
    {
        parent::__construct($model);
    }

    public function index(TalklikessDataTable $dataTable){
        return $dataTable->render('admin.talklikes.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.talklikes.edit' , $id);
    }

     public function store(AddRequestTalklikes $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/talklikes');
     }

     public function update($id , UpdateRequestTalklikes $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.talklikes.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/talklikes')->with('sucess' , 'Done Delete talklikes From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/talklikes')->with('sucess' , 'Done Delete talklikes From system');
    }

}
