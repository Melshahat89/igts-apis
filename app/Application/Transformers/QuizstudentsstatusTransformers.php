<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class QuizstudentsstatusTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"start_time" => $modelOrCollection->start_time,
			"end_time" => $modelOrCollection->end_time,
			"pause_time" => $modelOrCollection->pause_time,
			"status" => $modelOrCollection->status,
			"skipped_question_id" => $modelOrCollection->skipped_question_id,
			"passed" => $modelOrCollection->passed,
			"exam_anytime" => $modelOrCollection->exam_anytime,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
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