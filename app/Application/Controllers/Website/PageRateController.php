<?php

namespace App\Application\Controllers\Website;

use \App\Application\Requests\Website\PageRate\AddRequestPageRate;
use \App\Application\Requests\Website\PageRate\UpdateRequestPageRate;
use App\Application\Controllers\AbstractController;
use App\Application\Model\PageRate;
use App\Application\Model\Page;
use Yajra\Datatables\Request;
use Alert;

class PageRateController extends AbstractController
{

   public function __construct(PageRate $model , Page $parent)
    {
        parent::__construct($model);
        $this->parent = $parent;
    }

    public function addRate($id , AddRequestPageRate $request){
        if($this->checkIfUserRateBefore($id)){
            alert()->error(trans('admin.You have rate this before') , trans('admin.error'));
           return redirect('admin/page/'.$id.'/view');
        }
        $array = [
            'rate' => $request->rate,
            'user_id' => auth()->user()->id,
            'page_id' => $id
        ];
        $this->model->create($array);
        return redirect('page/'.$id.'/view');
    }

    public function checkIfUserRateBefore($id){
        $item = $this->model->where('id' , $id)->where('user_id' , auth()->user()->id)->first();
        return $item ? true : false;
    }
}