<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Courses\AddRequestCourses;
use App\Application\Requests\Admin\Courses\UpdateRequestCourses;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\CoursessDataTable;
use App\Application\Model\Courses;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Categories;
use App\Application\Model\Courseincludes;
use App\Application\Model\Courseresources;
use App\Application\Model\Coursesections;
use App\Application\Model\DynamicFields;
use App\Application\Model\Events;
use App\Application\Model\User;
use Illuminate\Support\Facades\Validator;

class CoursesController extends AbstractController
{
    public function __construct(Courses $model)
    {
        parent::__construct($model);
    }

    public function index(CoursessDataTable $dataTable){
        return $dataTable->render('admin.courses.index');
    }

    public function show($id = null){


        $data['allCats'] = Categories::where('status',1)->pluck('name','id');
        $data['allCourses'] = Courses::pluck('title','id');
        $data['allEvents'] = Events::where('status',1)->pluck('title','id');

        // $data['Allcourseincludes'] = Courseincludes::where('courses_id',$id)->pluck('included_course');

        $data['Allcourseincludes'] = Courses::where('id' , $id)->with('coursesincluded')->first();
        
        $data['Allcourserelated'] = Courses::where('id' , $id)->with('courserelated')->first();
        $data['Alleventincludes'] = Courses::where('id' , $id)->with('coursesrelatedevents')->first();


        // dd($data['Allcourseincludes']);

        return $this->createOrEdit('admin.courses.edit' , $id, $data);
    }

    public function showUpdate($id) {

        $this->data['sections'] = Coursesections::where('courses_id', $id)->orderBy('position', 'ASC')->get();
        $this->data['resources'] = Courseresources::where('courses_id', $id)->orderBy('position', 'ASC')->get();

        return $this->createOrEdit('admin.courses.update' , $id, $this->data);
 
    }

     public function store(AddRequestCourses $request){
       // dd($request->all());

       $instructor = User::findOrFail($request->all()['instructor_id']);
       $request->request->add(['doctor_name' => $request->all()['doctor_name'] . ' ' . $instructor->Fullname_ar . ' ' . $instructor->Fullname_en]); //add request

        $slug = str_replace(' ', '-', $request->all()['title']['ar']);
        $vdocipher_tag = str_replace(' ', '_', $request->all()['title']['en']);

        $request->request->add(['slug' => $slug]); //add request
        $request->request->add(['vdocipher_tag' => $vdocipher_tag]); //add request

          $item =  $this->storeOrUpdate($request , null , true);

          if(isset($request->all()['additional_field_title']['en'])){

            $title = $request->all()['additional_field_title'];
            $name = str_replace(' ', '_', $title['en']);
            $dynamicField = new DynamicFields();
            $dynamicField->name = $name;
            $dynamicField->title = json_encode($title);
            $dynamicField->description = (isset($request->all()['additional_field_description'])) ? json_encode($request->all()['additional_field_description']) : '';
            $dynamicField->model = 'courses';
            $dynamicField->model_id = $item->id;
            $dynamicField->save();
        }

          return redirect('lazyadmin/courses');
     }

     public function update($id , UpdateRequestCourses $request){

        $instructor = User::findOrFail($request->all()['instructor_id']);
        $request->request->add(['doctor_name' => $request->all()['doctor_name'] . ' ' . $instructor->Fullname_ar . ' ' . $instructor->Fullname_en]); //add request
        // $fields = $this->model->findOrFail($id);
        // $fields->coursesincluded()->sync($request->coursesincluded);
        if(isset($request->all()['additional_field_title']['ar']) && isset($request->all()['additional_field_title']['en'])){

            $title = $request->all()['additional_field_title'];
            $name = str_replace(' ', '_', $title['en']);
            $dynamicField = new DynamicFields();
            $dynamicField->name = $name;
            $dynamicField->title = json_encode($title);
            $dynamicField->description = (isset($request->all()['additional_field_description'])) ? json_encode($request->all()['additional_field_description']) : '';
            $dynamicField->model = 'courses';
            $dynamicField->model_id = $id;
            $dynamicField->save();
        }

        if(!isset($request->all()['vdocipher_tag'])){

            $vdocipher_tag = str_replace(' ', '_', $request->all()['title']['en']);
            $request->request->add(['vdocipher_tag' => $vdocipher_tag]); //add request

        }

        if(isset($request->all()['dynamicfields'])){
            
            foreach($request->all()['dynamicfields'] as $field){
                
                $dynamicField = DynamicFields::findOrFail($field['id']);

                $description = json_encode($field['description']);

                $dynamicField->description = $description;
                $dynamicField->save();
               
            }
        }

        
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

     }



    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.courses.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/courses')->with('sucess' , 'Done Delete courses From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/courses')->with('sucess' , 'Done Delete courses From system');
    }
    

}
