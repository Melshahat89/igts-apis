<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Testimonials\AddRequestTestimonials;
use App\Application\Requests\Admin\Testimonials\UpdateRequestTestimonials;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TestimonialssDataTable;
use App\Application\Model\Testimonials;
use Yajra\Datatables\Request;
use Alert;

class TestimonialsController extends AbstractController
{
    public function __construct(Testimonials $model)
    {
        parent::__construct($model);
    }

    public function index(TestimonialssDataTable $dataTable){
        return $dataTable->render('admin.testimonials.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.testimonials.edit' , $id);
    }

     public function store(AddRequestTestimonials $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/testimonials');
     }

     public function update($id , UpdateRequestTestimonials $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.testimonials.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/testimonials')->with('sucess' , 'Done Delete testimonials From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/testimonials')->with('sucess' , 'Done Delete testimonials From system');
    }

}
