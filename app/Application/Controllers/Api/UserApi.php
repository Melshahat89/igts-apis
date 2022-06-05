<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Courses;
use App\Application\Model\Coursewishlist;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Orders;
use App\Application\Model\Ordersposition;
use App\Application\Model\PostAffiliateProIntegration;
use App\Application\Model\User;
use App\Application\Requests\Website\User\ApiAddRequestUser;
use App\Application\Requests\Website\User\ApiLoginRequest;
use App\Application\Requests\Website\User\ApiUpdateRequestUser;
use App\Application\Transformers\CoursesTransformers;
use App\Application\Transformers\InstructorsTransformers;
use App\Application\Transformers\OrderspositionTransformers;
use App\Application\Transformers\UsersTransformers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserApi extends Controller
{

    use ApiTrait;
    protected $request;
    protected $model;

    public function __construct(User $model , Request $request)
    {
        $this->model = $model;
        $this->request = $request;
        $this->middleware('authApi')->only('update' , 'getUserByToken');
    }


    public function login(ApiLoginRequest $validation)
    {
        $request = $this->validateRequest($validation);
        if(!is_array($request)){
            return $request;
        }
        if (! $token = auth()->attempt($this->request->only(['email' , 'password']))) {
            return response(apiReturn('' , 'error' , 'invalid_credentials')  , 200 );
        }
        $user = $this->model->where('email' , $this->request->email)->first();
        $user->api_token = $this->generateToken();
        $user->save();
        return $this->checkLanguageBeforeReturn($user);
    }

    public function add(ApiAddRequestUser $validation){
        $request = $this->validateRequest($validation);
        if(!is_array($request)){
            return $request;
        }
        $request = $this->request->all();
        $request['group_id'] = env('DEFAULT_GROUP');
        $request['password'] = bcrypt($this->request->password);
        $request['api_token'] = $this->generateToken();
        $data = $this->model->create(checkApiHaveImage($request));
        return $this->checkLanguageBeforeReturn($data , 201);
    }

    public function update(ApiUpdateRequestUser $validation){
        $request = $this->validateRequest($validation);
        if(!is_array($request)){
            return $request;
        }
        $user = auth()->guard('api')->user();
        $request = $this->request->all();
        $request['password'] = bcrypt($this->request->password);
        $data = $user->update(checkApiHaveImage($request));
        return response(apiReturn($data)  , 200 );
    }

    public function getUserByToken(){
        $user = auth()->guard('api')->user();
        return response(apiReturn(UsersTransformers::transform($user))  , 200 );
    }

    public function generateToken(){
        return str_random(60);
    }

    public function instructors(){
        $limit = request()->has('limit') &&  (int) request()->get('limit') != 0 && (int) request()->get('limit') < 30 ? request()->get('limit') : env('PAGINATE');
        $data = $this->model->where('group_id',User::TYPE_INSTRUCTOR)->orderBy('id' , 'desc')->paginate($limit);

        if ($data) {
//            return response(apiReturn(array_values(InstructorsTransformers::transform($data) + $this->paginateArray($data))), 200);
            return response(apiReturn(['items' => array_values(InstructorsTransformers::transform($data))] + $this->paginateArray($data)), 200);

        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200,  $paginate = [])
    {
        return response(apiReturn(array_values(UsersTransformers::transform($data) + $paginate)), $status_code);
    }
    public function cart(){
        if (getShoppingCart()) {
            return response(apiReturn(OrderspositionTransformers::transform(getShoppingCart())), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    public function whishlist(){
        $Wishlist = Coursewishlist::where('user_id',Auth::guard('api')->user()->id)->pluck('courses_id');
        $courses = Courses::whereIn('id',$Wishlist)->get();
        if ($courses) {
            return response(apiReturn(CoursesTransformers::transform($courses)), 200);
        }
        return response(apiReturn('', '', 'No Data Found'), 200);
    }

    public function addToCart(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response(apiReturn($validator->errors(), '', $validator->errors()), 401);
        }

        $course = Courses::findOrfail($request->course_id);

        //Check the existing of pending order for this user
        $order = Orders::where('user_id', Auth::guard('api')->user()->id)->where('status', Orders::STATUS_PENDING)->orderBy('id', 'DESC')->first();;
        if (!$order) {
            $order = new Orders();
            $order->status = Orders::STATUS_PENDING;
            $order->user_id = Auth::guard('api')->user()->id;
            $order->save();
        }

        // Ceck if the order position found:
        $orderPosition = Ordersposition::where('courses_id', $course->id)->where('orders_id', $order->id)
            ->where('type', '!=', Ordersposition::TYPE_DIRECT_PAY)->orderBy('id', 'DESC')->first();
        if (!$orderPosition) {
            //Save the item in the cart
            $orderPosition = new Ordersposition();
            $orderPosition->amount = $course->OriginalPrice;
            $orderPosition->quantity = 1;
            $orderPosition->unit_price = $course->OriginalPrice;
            $orderPosition->currency = getCurrency();
            $orderPosition->orders_id = $order->id;
            $orderPosition->courses_id = $course->id;
            $orderPosition->user_id = Auth::guard('api')->user()->id;
            $orderPosition->type = Ordersposition::TYPE_Course;
            $orderPosition->save();
        }

        $order->save();

        return response(apiReturn(trans('website.Successfully added to cart'), '', ''), 200);
    }

    public function removeFromCart(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response(apiReturn($validator->errors(), '', $validator->errors()), 401);
        }
        // Remove item position
        $orderPosition = Courses::removeItemFromCart($request->item_id);
        if($orderPosition){
            return response(apiReturn(trans('website.The course has been deleted from the cart'), '', ''), 200);
        }
        return response(apiReturn(trans('website.Error Message'), '', ''), 200);
    }

    public function toggleFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response(apiReturn($validator->errors(), '', $validator->errors()), 401);
        }

        $Wishlisted = CourseWishlisted($request->course_id);

        if ($Wishlisted) {
            $Wishlist = Coursewishlist::where('user_id', Auth::guard('api')->user()->id)->where('courses_id', $request->course_id)->delete();
            return response(apiReturn(trans('website.Delete Course from favorite'), '', ''), 200);
        } else {
            $Coursewishlist = Coursewishlist::create([
                'user_id' => Auth::guard('api')->user()->id,
                'courses_id' => $request->course_id,
            ]);
            return response(apiReturn(trans('website.Add Course to favorite'), '', ''), 200);

        }
    }

}
