<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Categories\AddRequestCategories;
use App\Application\Requests\Admin\Categories\UpdateRequestCategories;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CategoriessDataTable;
use App\Application\Model\Categories;
use Yajra\Datatables\Request;
use Alert;

class CategoriesController extends AbstractController
{
    public function __construct(Categories $model)
    {
        parent::__construct($model);
    }

    public function index(CategoriessDataTable $dataTable){
        return $dataTable->render('admin.categories.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.categories.edit' , $id);
    }

     public function store(AddRequestCategories $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/categories');
     }

     public function update($id , UpdateRequestCategories $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.categories.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/categories')->with('sucess' , 'Done Delete categories From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/categories')->with('sucess' , 'Done Delete categories From system');
    }

}
