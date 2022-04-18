<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Quiz\AddRequestQuiz;
use App\Application\Requests\Admin\Quiz\UpdateRequestQuiz;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\QuizsDataTable;
use App\Application\Model\Quiz;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Quizquestions;

class QuizController extends AbstractController
{
    public function __construct(Quiz $model)
    {
        parent::__construct($model);
    }

    public function index(QuizsDataTable $dataTable){
        return $dataTable->render('admin.quiz.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.quiz.edit' , $id);
    }

     public function store(AddRequestQuiz $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/quiz');
     }

     public function update($id , UpdateRequestQuiz $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.quiz.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/quiz')->with('sucess' , 'Done Delete quiz From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/quiz')->with('sucess' , 'Done Delete quiz From system');
    }

    public function showUpdate($id) {

        $this->data['questions'] = Quizquestions::where('quiz_id', $id)->get();


        return $this->createOrEdit('admin.quiz.update' , $id, $this->data);

    }

}
