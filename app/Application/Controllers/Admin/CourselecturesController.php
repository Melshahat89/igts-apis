<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Courselectures\AddRequestCourselectures;
use App\Application\Requests\Admin\Courselectures\UpdateRequestCourselectures;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CourselecturessDataTable;
use App\Application\Model\Courselectures;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Courses;

class CourselecturesController extends AbstractController
{
    public function __construct(Courselectures $model)
    {
        parent::__construct($model);
    }

    public function index(CourselecturessDataTable $dataTable){
        return $dataTable->render('admin.courselectures.index');
    }

    public function show($id = null){
        
        $this->data = null;
        
        if(isset($_GET['section_id'])){
            $this->data['section_id'] = $_GET['section_id'];
        }

       

        return $this->createOrEdit('admin.courselectures.edit' , $id, $this->data);
    }

     public function store(AddRequestCourselectures $request){
        $lastLecture = Courselectures::where('courses_id', $request->all()['courses_id'])->where('coursesections_id', $request->all()['coursesections_id'])->orderBy('id', 'DESC')->first();
        if(isset($lastLecture) && $lastLecture->position){
            $request->request->add(['position'=> $lastLecture->position + 1]);
        }else{
            $request->request->add(['position'=> 1]);

        }
        
          $item =  $this->storeOrUpdate($request , null , true);
          //return redirect('lazyadmin/courselectures');
          return redirect()->back();
     }

     public function update($id , UpdateRequestCourselectures $request){

        if($request->vdocipher_id){
            $videos_duration = Courses::getSpecificVideoVdocipher($request->vdocipher_id);
            $request->request->add(['length' => $videos_duration->length]); 
        }

            $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.courselectures.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id)->with('sucess' , 'Done Delete courselectures From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/courselectures')->with('sucess' , 'Done Delete courselectures From system');
    }

    public function updateLecturePos($id) {

        $lecture = Courselectures::find($id);

        if(isset($_GET['index'])) {

            
            $lecture->position = $_GET['index'];
            $lecture->save();
        }

        return $_GET['index'];
    }
}
