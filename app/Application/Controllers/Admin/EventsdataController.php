<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Eventsdata\AddRequestEventsdata;
use App\Application\Requests\Admin\Eventsdata\UpdateRequestEventsdata;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\EventsdatasDataTable;
use App\Application\Model\Eventsdata;
use Yajra\Datatables\Request;
use Alert;

class EventsdataController extends AbstractController
{
    public function __construct(Eventsdata $model)
    {
        parent::__construct($model);
    }

    public function index(EventsdatasDataTable $dataTable){
        return $dataTable->render('admin.eventsdata.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.eventsdata.edit' , $id);
    }

     public function store(AddRequestEventsdata $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/eventsdata');
     }

     public function update($id , UpdateRequestEventsdata $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.eventsdata.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/eventsdata')->with('sucess' , 'Done Delete eventsdata From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/eventsdata')->with('sucess' , 'Done Delete eventsdata From system');
    }

}
