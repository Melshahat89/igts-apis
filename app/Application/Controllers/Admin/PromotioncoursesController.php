<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Promotioncourses\AddRequestPromotioncourses;
use App\Application\Requests\Admin\Promotioncourses\UpdateRequestPromotioncourses;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PromotioncoursessDataTable;
use App\Application\Model\Promotioncourses;
use Yajra\Datatables\Request;
use Alert;

class PromotioncoursesController extends AbstractController
{
    public function __construct(Promotioncourses $model)
    {
        parent::__construct($model);
    }

    public function index(PromotioncoursessDataTable $dataTable){
        return $dataTable->render('admin.promotioncourses.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.promotioncourses.edit' , $id);
    }

     public function store(AddRequestPromotioncourses $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/promotioncourses');
     }

     public function update($id , UpdateRequestPromotioncourses $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.promotioncourses.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/promotioncourses')->with('sucess' , 'Done Delete promotioncourses From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/promotioncourses')->with('sucess' , 'Done Delete promotioncourses From system');
    }

}
