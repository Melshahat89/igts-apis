<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Tickets\AddRequestTickets;
use App\Application\Requests\Admin\Tickets\UpdateRequestTickets;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TicketssDataTable;
use App\Application\Model\Tickets;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Ticketsreplay;

class TicketsController extends AbstractController
{
    public function __construct(Tickets $model)
    {
        parent::__construct($model);
    }

    public function index(TicketssDataTable $dataTable){
        return $dataTable->render('admin.tickets.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.tickets.edit' , $id);
    }

     public function store(AddRequestTickets $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/tickets');
     }

     public function update($id , UpdateRequestTickets $request){
            $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);

        $replay = Ticketsreplay::where('tickets_id',$id)->get();

        
        $fields->replay = $replay ;
        

        
        
        return $this->createOrEdit('admin.tickets.show' , $id , ['fields' =>  $fields , 'replay' => $replay]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/tickets')->with('sucess' , 'Done Delete tickets From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/tickets')->with('sucess' , 'Done Delete tickets From system');
    }

}
