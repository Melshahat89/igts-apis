<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Coursewishlist\AddRequestCoursewishlist;
use App\Application\Requests\Admin\Coursewishlist\UpdateRequestCoursewishlist;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CoursewishlistsDataTable;
use App\Application\Model\Coursewishlist;
use Yajra\Datatables\Request;
use Alert;

class CoursewishlistController extends AbstractController
{
    public function __construct(Coursewishlist $model)
    {
        parent::__construct($model);
    }

    public function index(CoursewishlistsDataTable $dataTable){
        return $dataTable->render('admin.coursewishlist.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.coursewishlist.edit' , $id);
    }

     public function store(AddRequestCoursewishlist $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/coursewishlist');
     }

     public function update($id , UpdateRequestCoursewishlist $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.coursewishlist.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/coursewishlist')->with('sucess' , 'Done Delete coursewishlist From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/coursewishlist')->with('sucess' , 'Done Delete coursewishlist From system');
    }

}
