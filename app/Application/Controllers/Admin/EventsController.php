<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Events\AddRequestEvents;
use App\Application\Requests\Admin\Events\UpdateRequestEvents;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\EventssDataTable;
use App\Application\Model\Events;
use Yajra\Datatables\Request;
use Alert;

class EventsController extends AbstractController
{
    public function __construct(Events $model)
    {
        parent::__construct($model);
    }

    public function index(EventssDataTable $dataTable){
        return $dataTable->render('admin.events.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.events.edit' , $id);
    }

     public function store(AddRequestEvents $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/events');
     }

     public function update($id , UpdateRequestEvents $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.events.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/events')->with('sucess' , 'Done Delete events From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/events')->with('sucess' , 'Done Delete events From system');
    }

}
