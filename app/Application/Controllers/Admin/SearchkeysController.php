<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Searchkeys\AddRequestSearchkeys;
use App\Application\Requests\Admin\Searchkeys\UpdateRequestSearchkeys;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\SearchkeyssDataTable;
use App\Application\Model\Searchkeys;
use Yajra\Datatables\Request;
use Alert;

class SearchkeysController extends AbstractController
{
    public function __construct(Searchkeys $model)
    {
        parent::__construct($model);
    }

    public function index(SearchkeyssDataTable $dataTable){
        return $dataTable->render('admin.searchkeys.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.searchkeys.edit' , $id);
    }

     public function store(AddRequestSearchkeys $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/searchkeys');
     }

     public function update($id , UpdateRequestSearchkeys $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.searchkeys.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/searchkeys')->with('sucess' , 'Done Delete searchkeys From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/searchkeys')->with('sucess' , 'Done Delete searchkeys From system');
    }

}
