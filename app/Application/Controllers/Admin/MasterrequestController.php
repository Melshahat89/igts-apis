<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Masterrequest\AddRequestMasterrequest;
use App\Application\Requests\Admin\Masterrequest\UpdateRequestMasterrequest;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\MasterrequestsDataTable;
use App\Application\Model\Masterrequest;
use Yajra\Datatables\Request;
use Alert;

class MasterrequestController extends AbstractController
{
    public function __construct(Masterrequest $model)
    {
        parent::__construct($model);
    }

    public function index(MasterrequestsDataTable $dataTable){
        return $dataTable->render('admin.masterrequest.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.masterrequest.edit' , $id);
    }

     public function store(AddRequestMasterrequest $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/masterrequest');
     }

     public function update($id , UpdateRequestMasterrequest $request){
          if ($request->has("oldFiles_documentation") && $request->oldFiles_documentation != "") {
                                        $oldImage_documentation = $request->oldFiles_documentation;
                                        $request->request->remove("oldFiles_documentation");
                                    } else {
                                        $oldImage_documentation = json_encode([]);
                                    }
$item = $this->storeOrUpdate($request, $id, true);
if ($item) {
                                    $image = json_decode($item->documentation) ?? [];
                                    $newIamge = json_decode($oldImage_documentation) ?? [];
                                    $item_image = array_unique(array_merge($image, $newIamge));
                                    $item->documentation = json_encode($item_image);
                                    $item->save();
                                }
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.masterrequest.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/masterrequest')->with('sucess' , 'Done Delete masterrequest From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/masterrequest')->with('sucess' , 'Done Delete masterrequest From system');
    }

}
