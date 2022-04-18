<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Quizquestions\AddRequestQuizquestions;
use App\Application\Requests\Admin\Quizquestions\UpdateRequestQuizquestions;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\QuizquestionssDataTable;
use App\Application\Model\Quizquestions;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Quizquestionschoice;
use DB;

class QuizquestionsController extends AbstractController
{
    public function __construct(Quizquestions $model)
    {
        parent::__construct($model);
    }

    public function index(QuizquestionssDataTable $dataTable){
        return $dataTable->render('admin.quizquestions.index');
    }

    public function show($id = null){

        $this->data = null;
        
        if(isset($_GET['section_id'])){
            $this->data['section_id'] = $_GET['section_id'];
        }

        return $this->createOrEdit('admin.quizquestions.edit' , $id, $this->data);
    }

     public function store(AddRequestQuizquestions $request){

        //  $nextQuestionId = DB::select("SHOW TABLE STATUS LIKE 'quizquestions'")[0]->Auto_increment;
         $item =  $this->storeOrUpdate($request , null , true);
        
         $this->storeOrUpdateQuestionChoices($request, $item->id);


          //return redirect('lazyadmin/quizquestions');
          return redirect()->back();
     }

     public function update($id , UpdateRequestQuizquestions $request){
         //dd($request->all());
          $item = $this->storeOrUpdate($request, $id, true);

          $this->storeOrUpdateQuestionChoices($request, $item->id);

        return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.quizquestions.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id)->with('sucess' , 'Done Delete quizquestions From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/quizquestions')->with('sucess' , 'Done Delete quizquestions From system');
    }

    public function addInput($counter) {

        
        return extractTextFiledAutoIncrement(null, "choice", '' , '', null, $counter);
    }

}
