<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Transactions\AddRequestTransactions;
use App\Application\Requests\Admin\Transactions\UpdateRequestTransactions;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TransactionssDataTable;
use App\Application\Model\Transactions;
use Yajra\Datatables\Request;
use Maatwebsite\Excel\Facades\Excel;

use Alert;
use App\Application\Model\Courses;
use App\Application\Model\Orders;
use App\Application\Model\Payments;

class TransactionsController extends AbstractController
{
    public function __construct(Transactions $model)
    {
        parent::__construct($model);
    }

    public function index(TransactionssDataTable $dataTable){
        return $dataTable->render('admin.transactions.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.transactions.edit' , $id);
    }

     public function store(AddRequestTransactions $request){
         //dd($request->all());

         if (request()->has('transactionsFile') && request()->has('transaction_date')) {

            Global $arr;
            $arr = array();
            try {
                Excel::load($request->transactionsFile, function ($reader) {
                    
                    global $arr;
                    foreach ($reader->toArray() as $key => $row) {

                        $course = Courses::findOrFail($row['course_id']);

                        $amount = $row['amount'];
                        
                        $transactions = Transactions::getSumTransactions($course->id, $course->instructor_id, Transactions::INSTRUCTOR, request()->transaction_date);
                        $amount = abs($transactions - $amount);

                        $order = createDirectPayOrder($course);
                        $order->status = Orders::STATUS_SUCCEEDED;

                        $payment = new Payments();
                        $payment->orders_id = $order->id;
                        $payment->amount = $amount;
                        $payment->currency_id = 34;
                        $payment->status = Payments::STATUS_SUCCEEDED;
                        $payment->save();

                        $order->payments_id = $payment->id;
                        $order->save();

                        distCourseTransactions($course, $amount, $payment, null, $course);
                    }
                });


                alert()->success("Transactions have been updated", trans('website.Success'));

            } catch (\Exception $e) {
                alert()->error($e->getMessage(), "Error");
            }

        }

          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/transactions');
     }

     public function update($id , UpdateRequestTransactions $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.transactions.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/transactions')->with('sucess' , 'Done Delete transactions From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/transactions')->with('sucess' , 'Done Delete transactions From system');
    }

}
