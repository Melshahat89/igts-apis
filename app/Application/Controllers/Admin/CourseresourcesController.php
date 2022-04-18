<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Courseresources\AddRequestCourseresources;
use App\Application\Requests\Admin\Courseresources\UpdateRequestCourseresources;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CourseresourcessDataTable;
use App\Application\Model\Courseresources;
use Yajra\Datatables\Request;
use Alert;

class CourseresourcesController extends AbstractController
{
    public function __construct(Courseresources $model)
    {
        parent::__construct($model);
    }

    public function index(CourseresourcessDataTable $dataTable){
        return $dataTable->render('admin.courseresources.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.courseresources.edit' , $id);
    }

     public function store(AddRequestCourseresources $request){


         $resources = $request->all()['file'];

         foreach($resources as $resource) {

            $fileName = $resource->getClientOriginalName();
            $uploadedFileName = $this->uploadFiles($resource, env('UPLOAD_PATH'));

            $courseResource = new Courseresources();
            $courseResource->courses_id = $request->all()['courses_id'];
            $courseResource->title = json_encode([
                'en' => $fileName,
                'ar' => $fileName
            ], JSON_UNESCAPED_UNICODE);          
            $courseResource->file = $uploadedFileName;
            $courseResource->save();
         }

    
         return redirect()->back();
          //$item =  $this->storeOrUpdate($request , null , true);
          //return redirect('lazyadmin/courseresources');
     }

     public function update($id , UpdateRequestCourseresources $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.courseresources.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id)->with('sucess' , 'Done Delete courseresources From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/courseresources')->with('sucess' , 'Done Delete courseresources From system');
    }

    public function updateResourcePos($id) {

        $resource = Courseresources::find($id);

        if(isset($_GET['index'])) {

            
            $resource->position = $_GET['index'];
            $resource->save();
        }

        return $_GET['index'];
    }
}
