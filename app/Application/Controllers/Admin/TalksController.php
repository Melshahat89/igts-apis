<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Talks\AddRequestTalks;
use App\Application\Requests\Admin\Talks\UpdateRequestTalks;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TalkssDataTable;
use App\Application\Model\Talks;
use Yajra\Datatables\Request;
use Alert;

class TalksController extends AbstractController
{
    public function __construct(Talks $model)
    {
        parent::__construct($model);
    }

    public function index(TalkssDataTable $dataTable){
        return $dataTable->render('admin.talks.index');
    }

    public function show($id = null){

        $data['allTalks'] = Talks::where('published', 1)->pluck('title', 'id');
        $data['Alltalksrelated'] = Talks::where('id' , $id)->with('talksrelated')->first();

        return $this->createOrEdit('admin.talks.edit' , $id, $data);
    }

     public function store(AddRequestTalks $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/talks');
     }

     public function update($id , UpdateRequestTalks $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.talks.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/talks')->with('sucess' , 'Done Delete talks From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/talks')->with('sucess' , 'Done Delete talks From system');
    }

}
