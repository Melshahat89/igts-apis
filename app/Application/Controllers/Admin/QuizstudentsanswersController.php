<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Quizstudentsanswers\AddRequestQuizstudentsanswers;
use App\Application\Requests\Admin\Quizstudentsanswers\UpdateRequestQuizstudentsanswers;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\QuizstudentsanswerssDataTable;
use App\Application\Model\Quizstudentsanswers;
use Yajra\Datatables\Request;
use Alert;

class QuizstudentsanswersController extends AbstractController
{
    public function __construct(Quizstudentsanswers $model)
    {
        parent::__construct($model);
    }

    public function index(QuizstudentsanswerssDataTable $dataTable){
        return $dataTable->render('admin.quizstudentsanswers.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.quizstudentsanswers.edit' , $id);
    }

     public function store(AddRequestQuizstudentsanswers $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/quizstudentsanswers');
     }

     public function update($id , UpdateRequestQuizstudentsanswers $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.quizstudentsanswers.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/quizstudentsanswers')->with('sucess' , 'Done Delete quizstudentsanswers From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/quizstudentsanswers')->with('sucess' , 'Done Delete quizstudentsanswers From system');
    }

}
