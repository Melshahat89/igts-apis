<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use Yajra\Datatables\Request;
use Alert;
use App\Application\DataTables\CertificatesDataTable;
use App\Application\Model\Certificates;
use App\Application\Model\Courses;
use App\Application\Requests\Admin\Certificates\AddRequestCertificates;
use App\Application\Requests\Admin\Certificates\UpdateRequestCertificates;

class CertificatesController extends AbstractController
{
    public function __construct(Certificates $model)
    {
        parent::__construct($model);
    }

    public function index(CertificatesDataTable $dataTable){
        return $dataTable->render('admin.certificates.index');
    }

    public function show($id = null){

        $data['allCourses'] = Courses::pluck('title','id');

        if($id){
            $data['Allcourserelated'] = Certificates::where('id', $id)->with('certificatesrelatedcourses')->first()->certificatesrelatedcourses;
        }
        
        return $this->createOrEdit('admin.certificates.edit' , $id, $data);
    }

     public function store(AddRequestCertificates $request){

          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/certificates');
     }

     public function update($id , UpdateRequestCertificates $request){

          $item = $this->storeOrUpdate($request, $id, true);
            return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.certificates.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/certificates')->with('sucess' , 'Done Delete certificates From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/certificates')->with('sucess' , 'Done Delete certificates From system');
    }

}
