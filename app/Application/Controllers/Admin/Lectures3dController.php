<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Lectures3d\AddRequestLectures3d;
use App\Application\Requests\Admin\Lectures3d\UpdateRequestLectures3d;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\Lectures3dsDataTable;
use App\Application\Model\Lectures3d;
use Yajra\Datatables\Request;
use Alert;

class Lectures3dController extends AbstractController
{
    public function __construct(Lectures3d $model)
    {
        parent::__construct($model);
    }

    public function index(Lectures3dsDataTable $dataTable){
        return $dataTable->render('admin.lectures3d.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.lectures3d.edit' , $id);
    }

     public function store(AddRequestLectures3d $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/lectures3d');
     }

     public function update($id , UpdateRequestLectures3d $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.lectures3d.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/lectures3d')->with('sucess' , 'Done Delete lectures3d From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/lectures3d')->with('sucess' , 'Done Delete lectures3d From system');
    }

}
