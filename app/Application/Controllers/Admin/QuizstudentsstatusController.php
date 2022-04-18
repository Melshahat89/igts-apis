<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Quizstudentsstatus\AddRequestQuizstudentsstatus;
use App\Application\Requests\Admin\Quizstudentsstatus\UpdateRequestQuizstudentsstatus;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\QuizstudentsstatussDataTable;
use App\Application\Model\Quizstudentsstatus;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Quiz;

class QuizstudentsstatusController extends AbstractController
{
    public function __construct(Quizstudentsstatus $model)
    {
        parent::__construct($model);
    }

    public function index(QuizstudentsstatussDataTable $dataTable){
        return $dataTable->render('admin.quizstudentsstatus.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.quizstudentsstatus.edit' , $id);
    }

     public function store(AddRequestQuizstudentsstatus $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/quizstudentsstatus');
     }

     public function update($id , UpdateRequestQuizstudentsstatus $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.quizstudentsstatus.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/quizstudentsstatus')->with('sucess' , 'Done Delete quizstudentsstatus From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/quizstudentsstatus')->with('sucess' , 'Done Delete quizstudentsstatus From system');
    }

    public function reExam($id){

        $quizStatus = Quizstudentsstatus::findOrFail($id);

        if($quizStatus->status == 4 && $quizStatus->passed == 0){
            $quizStatus->exam_anytime = 1;
            $quizStatus->save();
        }
        return redirect()->back();
    }

}
