<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Social\AddRequestSocial;
use App\Application\Requests\Admin\Social\UpdateRequestSocial;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\SocialsDataTable;
use App\Application\Model\Social;
use Yajra\Datatables\Request;
use Alert;

class SocialController extends AbstractController
{
    public function __construct(Social $model)
    {
        parent::__construct($model);
    }

    public function index(SocialsDataTable $dataTable){
        return $dataTable->render('admin.social.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.social.edit' , $id);
    }

     public function store(AddRequestSocial $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/social');
     }

     public function update($id , UpdateRequestSocial $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.social.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/social')->with('sucess' , 'Done Delete social From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/social')->with('sucess' , 'Done Delete social From system');
    }

}
