<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Eventsreviews\AddRequestEventsreviews;
use App\Application\Requests\Admin\Eventsreviews\UpdateRequestEventsreviews;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\EventsreviewssDataTable;
use App\Application\Model\Eventsreviews;
use Yajra\Datatables\Request;
use Alert;

class EventsreviewsController extends AbstractController
{
    public function __construct(Eventsreviews $model)
    {
        parent::__construct($model);
    }

    public function index(EventsreviewssDataTable $dataTable){
        return $dataTable->render('admin.eventsreviews.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.eventsreviews.edit' , $id);
    }

     public function store(AddRequestEventsreviews $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/eventsreviews');
     }

     public function update($id , UpdateRequestEventsreviews $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.eventsreviews.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/eventsreviews')->with('sucess' , 'Done Delete eventsreviews From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/eventsreviews')->with('sucess' , 'Done Delete eventsreviews From system');
    }

}
