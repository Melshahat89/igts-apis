<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Eventstickets\AddRequestEventstickets;
use App\Application\Requests\Admin\Eventstickets\UpdateRequestEventstickets;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\EventsticketssDataTable;
use App\Application\Model\Eventstickets;
use Yajra\Datatables\Request;
use Alert;

class EventsticketsController extends AbstractController
{
    public function __construct(Eventstickets $model)
    {
        parent::__construct($model);
    }

    public function index(EventsticketssDataTable $dataTable){
        return $dataTable->render('admin.eventstickets.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.eventstickets.edit' , $id);
    }

     public function store(AddRequestEventstickets $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/eventstickets');
     }

     public function update($id , UpdateRequestEventstickets $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.eventstickets.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/eventstickets')->with('sucess' , 'Done Delete eventstickets From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/eventstickets')->with('sucess' , 'Done Delete eventstickets From system');
    }

}
