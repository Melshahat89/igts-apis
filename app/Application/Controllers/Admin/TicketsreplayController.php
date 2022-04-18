<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Ticketsreplay\AddRequestTicketsreplay;
use App\Application\Requests\Admin\Ticketsreplay\UpdateRequestTicketsreplay;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TicketsreplaysDataTable;
use App\Application\Model\Ticketsreplay;
use Yajra\Datatables\Request;
use Alert;

class TicketsreplayController extends AbstractController
{
    public function __construct(Ticketsreplay $model)
    {
        parent::__construct($model);
    }

    public function index(TicketsreplaysDataTable $dataTable){
        return $dataTable->render('admin.ticketsreplay.index');
    }

    public function show($id = null){

      
        
        return $this->createOrEdit('admin.ticketsreplay.edit' , $id);
    }

     public function store(AddRequestTicketsreplay $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/ticketsreplay');
     }

     public function update($id , UpdateRequestTicketsreplay $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('lazyadmin.ticketsreplay.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/ticketsreplay')->with('sucess' , 'Done Delete ticketsreplay From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/ticketsreplay')->with('sucess' , 'Done Delete ticketsreplay From system');
    }

}
