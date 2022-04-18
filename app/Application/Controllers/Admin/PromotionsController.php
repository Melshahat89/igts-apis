<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Promotions\AddRequestPromotions;
use App\Application\Requests\Admin\Promotions\UpdateRequestPromotions;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\PromotionssDataTable;
use App\Application\Model\Promotions;
use Yajra\Datatables\Request;
use Alert;
use App\Application\Model\Courses;
use App\Application\Model\Events;
use App\Application\Model\Eventsdata;
use App\Application\Model\User;

class PromotionsController extends AbstractController
{
    public function __construct(Promotions $model)
    {
        parent::__construct($model);
    }

    public function index(PromotionssDataTable $dataTable){
        return $dataTable->render('admin.promotions.index');
    }

    public function show($id = null){

        $instructors = User::where('is_instructor', 1)->pluck('email', 'id')->toArray();
        $eventsData = Eventsdata::pluck('email', 'user_id')->toArray();
        $data['instructors'] = array_unique($instructors + $eventsData);

        $data['allCourses'] = Courses::pluck('title','id');
        $data['allEvents'] = Events::where('status',1)->pluck('title','id');

        $data['Allcourseincludes'] = Promotions::where('id' , $id)->with('promotioncoursesincluded')->first();
        $data['AllEventincludes'] = Promotions::where('id' , $id)->with('promotioneventsincluded')->first();


        return $this->createOrEdit('admin.promotions.edit' , $id, $data);
    }

     public function store(AddRequestPromotions $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/promotions');
     }

     public function update($id , UpdateRequestPromotions $request){

          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.promotions.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/promotions')->with('sucess' , 'Done Delete promotions From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/promotions')->with('sucess' , 'Done Delete promotions From system');
    }

}
