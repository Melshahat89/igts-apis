<?php
 namespace App\Application\Requests\Website\Quizquestions;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestQuizquestions
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"quiz_id" => "required|integer",
            "question" => "type",
   "mark" => "",
            ];
    }
}
