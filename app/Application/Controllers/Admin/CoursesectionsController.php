<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Coursesections\AddRequestCoursesections;
use App\Application\Requests\Admin\Coursesections\UpdateRequestCoursesections;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CoursesectionssDataTable;
use App\Application\Model\Coursesections;
use Yajra\Datatables\Request;
use Alert;

class CoursesectionsController extends AbstractController
{
    public function __construct(Coursesections $model)
    {
        parent::__construct($model);
    }

    public function index(CoursesectionssDataTable $dataTable){
        return $dataTable->render('admin.coursesections.index');
    }

    public function show($id = null){
        $this->data = null;
        
        if(isset($_GET['section_id'])){
            $this->data['section_id'] = $_GET['section_id'];
        }

        return $this->createOrEdit('admin.coursesections.edit' , $id, $this->data);
    }

     public function store(AddRequestCoursesections $request){
          $item =  $this->storeOrUpdate($request , null , true);
          //return redirect('lazyadmin/coursesections');
          return redirect()->back();

     }

     public function update($id , UpdateRequestCoursesections $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.coursesections.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id)->with('sucess' , 'Done Delete coursesections From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/coursesections')->with('sucess' , 'Done Delete coursesections From system');
    }

    public function updateSectionPos($id) {

        $section = Coursesections::find($id);

        if(isset($_GET['index'])) {

            
            $section->position = $_GET['index'];
            $section->save();
        }

        return $_GET['index'];
    }
}
