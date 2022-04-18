<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Quizquestionschoice\AddRequestQuizquestionschoice;
use App\Application\Requests\Admin\Quizquestionschoice\UpdateRequestQuizquestionschoice;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\QuizquestionschoicesDataTable;
use App\Application\Model\Quizquestionschoice;
use Yajra\Datatables\Request;
use Alert;

class QuizquestionschoiceController extends AbstractController
{
    public function __construct(Quizquestionschoice $model)
    {
        parent::__construct($model);
    }

    public function index(QuizquestionschoicesDataTable $dataTable){
        return $dataTable->render('admin.quizquestionschoice.index');
    }

    public function show($id = null){

        $this->data = null;
        if($id) {

            $choice = Quizquestionschoice::find($id);

            $this->data['allChoices'] = Quizquestionschoice::where('quizquestions_id', $choice->quizquestions_id)->get();

        }

        return $this->createOrEdit('admin.quizquestionschoice.edit' , $id, $this->data);
    }

     public function store(AddRequestQuizquestionschoice $request){

        //dd($request->all());
        //$item =  $this->storeOrUpdate($request , null , true);

        $quizquestions_id = $request->all()['quizquestions_id'];

        $this->storeOrUpdateQuestionChoices($request, $quizquestions_id);

          //return redirect('lazyadmin/quizquestionschoice');

          return redirect()->back();
     }

     public function update($id , UpdateRequestQuizquestionschoice $request){

        //$item = $this->storeOrUpdate($request, $id, true);

        $quizquestions_id = $request->all()['quizquestions_id'];

        $this->storeOrUpdateQuestionChoices($request, $quizquestions_id);


return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.quizquestionschoice.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id)->with('sucess' , 'Done Delete quizquestionschoice From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/quizquestionschoice')->with('sucess' , 'Done Delete quizquestionschoice From system');
    }

}
