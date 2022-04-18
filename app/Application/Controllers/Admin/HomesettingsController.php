<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Homesettings\AddRequestHomesettings;
use App\Application\Requests\Admin\Homesettings\UpdateRequestHomesettings;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\HomesettingssDataTable;
use App\Application\Model\Homesettings;
use Yajra\Datatables\Request;
use Alert;

class HomesettingsController extends AbstractController
{
    public function __construct(Homesettings $model)
    {
        parent::__construct($model);
    }

    public function index(HomesettingssDataTable $dataTable){
        return $dataTable->render('admin.homesettings.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.homesettings.edit' , $id);
    }

     public function store(AddRequestHomesettings $request){
        //   $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/homesettings');
     }

     public function update($id , UpdateRequestHomesettings $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.homesettings.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        // return $this->deleteItem($id , 'lazyadmin/homesettings')->with('sucess' , 'Done Delete homesettings From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/homesettings')->with('sucess' , 'Done Delete homesettings From system');
    }

}
