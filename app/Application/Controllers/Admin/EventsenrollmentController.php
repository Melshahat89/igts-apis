<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Eventsenrollment\AddRequestEventsenrollment;
use App\Application\Requests\Admin\Eventsenrollment\UpdateRequestEventsenrollment;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\EventsenrollmentsDataTable;
use App\Application\Model\Eventsenrollment;
use Yajra\Datatables\Request;
use Alert;

class EventsenrollmentController extends AbstractController
{
    public function __construct(Eventsenrollment $model)
    {
        parent::__construct($model);
    }

    public function index(EventsenrollmentsDataTable $dataTable){
        return $dataTable->render('admin.eventsenrollment.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.eventsenrollment.edit' , $id);
    }

     public function store(AddRequestEventsenrollment $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/eventsenrollment');
     }

     public function update($id , UpdateRequestEventsenrollment $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.eventsenrollment.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/eventsenrollment')->with('sucess' , 'Done Delete eventsenrollment From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/eventsenrollment')->with('sucess' , 'Done Delete eventsenrollment From system');
    }

}
