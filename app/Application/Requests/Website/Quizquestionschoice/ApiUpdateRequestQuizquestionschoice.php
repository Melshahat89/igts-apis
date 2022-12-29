<?php
 namespace App\Application\Requests\Website\Quizquestionschoice;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestQuizquestionschoice
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"quizquestions_id" => "required|integer",
            "choice" => "",
   "is_correct" => "",
            ];
    }
}
