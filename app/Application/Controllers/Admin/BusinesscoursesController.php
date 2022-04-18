<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Businesscourses\AddRequestBusinesscourses;
use App\Application\Requests\Admin\Businesscourses\UpdateRequestBusinesscourses;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\BusinesscoursessDataTable;
use App\Application\Model\Businesscourses;
use Yajra\Datatables\Request;
use Alert;

class BusinesscoursesController extends AbstractController
{
    public function __construct(Businesscourses $model)
    {
        parent::__construct($model);
    }

    public function index(BusinesscoursessDataTable $dataTable){
        return $dataTable->render('admin.businesscourses.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.businesscourses.edit' , $id);
    }

     public function store(AddRequestBusinesscourses $request){
         

        if(request()->has('courses_id') && request()->post('courses_id') != ''){
            foreach(request()->post('courses_id') as $courseID){
                $request->request->add(['courses_id'=> $courseID]) ;
                $item =  $this->storeOrUpdate($request , null , true);
            }
            
        }

        
        return redirect('lazyadmin/businesscourses');

          
          
     }

     public function update($id , UpdateRequestBusinesscourses $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.businesscourses.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/businesscourses')->with('sucess' , 'Done Delete businesscourses From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/businesscourses')->with('sucess' , 'Done Delete businesscourses From system');
    }

}
