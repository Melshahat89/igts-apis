<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizstudentsstatusTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
            "studentPercentage" => $modelOrCollection->CurrentStudentPercentage,
            "certificate" => $modelOrCollection->certificate,
            "title" => $modelOrCollection['quiz']['courses']['title_lang'],
            "course_id" => $modelOrCollection['quiz']['courses']['id'],




			"start_time" => $modelOrCollection->start_time,
			"end_time" => $modelOrCollection->end_time,
			"pause_time" => $modelOrCollection->pause_time,
			"status" => $modelOrCollection->status,
			"skipped_question_id" => $modelOrCollection->skipped_question_id,
			"passed" => $modelOrCollection->passed,
			"exam_anytime" => $modelOrCollection->exam_anytime,

        ];
    }

}