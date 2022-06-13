<?php

namespace App\Application\Controllers\Api;

use App\Application\Controllers\Controller;
use App\Application\Model\User;
use App\Application\Transformers\InstructorsTransformers;
use App\Application\Transformers\UserTransformers;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthControllerApi extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validatorLogin(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'mobile' => 'required|max:15',
//            'categories' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response(apiReturn(['error'=>$validator->errors()],'error', ['error'=>$validator->errors()] ), 401);
        }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' =>  bcrypt($request->password),
//                'categories' => $request->categories,
                'group_id' => env('DEFAULT_GROUP'),
                'activated' => env('DEFAULT_activated'),
                'businessdata_id' => isset($request->businessdata_id) ?$request->businessdata_id:null,
            ]);
        $user = User::find($user->id);
        if($user){
//            $user = Auth::user();
            Auth::login($user);
                return response(apiReturn((UserTransformers::transform($user))), 200);
        }
    }
    public function login(Request $request){
        $this->validatorLogin($request->all())->validate();
        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'banned' => 0])){
            $user = Auth::user();
            if ($user) {
                return response(apiReturn((UserTransformers::transform($user))), 200);
            }
        }
        else{
            return response(apiReturn('', '', 'Unauthorised'), 200);
        }
    }

    public function resetPasswordRequest(Request $request){

        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ],
            [
                'phone.required' => [
                    'ErrorCode' =>  1010,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1010',[],'ar'),
                        'en' => trans('errors.1010',[],'en'),
                        'ku' => trans('errors.1010',[],'ku')
                    ]
                ],
                'phone.min' => [
                    'string' => [
                        'ErrorCode' =>  1011,
                        'ErrorMessage' =>  [
                            'ar' => trans('errors.1011',[],'ar'),
                            'en' => trans('errors.1011',[],'en'),
                            'ku' => trans('errors.1011',[],'ku')
                        ]
                    ]
                ],
                'phone.regex' => [
                    'ErrorCode' =>  1017,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1017',[],'ar'),
                        'en' => trans('errors.1017',[],'en'),
                        'ku' => trans('errors.1017',[],'ku')
                    ]
                ],

            ]
        );

        if($validator->fails()){
            $response = array_merge(array_values($validator->errors()->getMessages())[0][0], [
                'Success' => false,
                'response' => []
            ]);
            return Response::make($response);
        }
        else{
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => [
                        'ar' => trans('errors.1026',[],'ar'),
                        'en' => trans('errors.1026',[],'en'),
                        'ku' => trans('errors.1026',[],'ku')
                    ],
                    'ErrorCode' => 1026,
                    'response' => []
                ]);
            }else{
//                $verification_code = random_int(1000, 9999);
                $verification_code = '0000';
                $user->verification_code = $verification_code;
                $user->save();

                //Send Otp
                $otpController = new OTPVerificationController();
                $otpController->send_code($request->phone,$verification_code);

                return Response::make([
                    'Success' => true,
                    'ErrorMessage' => null,
                    'ErrorCode' => null,
                    'response' => [
                        'otp'=>  $verification_code
                    ]
                ]);
            }


        }
    }
    public function resetPasswordConfirm(Request $request){

        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'otp' => 'required',
        ],[
                'phone.required' => [
                    'ErrorCode' =>  1010,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1010',[],'ar'),
                        'en' => trans('errors.1010',[],'en'),
                        'ku' => trans('errors.1010',[],'ku')
                    ]
                ],
                'phone.min' => [
                    'string' => [
                        'ErrorCode' =>  1011,
                        'ErrorMessage' =>  [
                            'ar' => trans('errors.1011',[],'ar'),
                            'en' => trans('errors.1011',[],'en'),
                            'ku' => trans('errors.1011',[],'ku')
                        ]
                    ]
                ],
                'phone.regex' => [
                    'ErrorCode' =>  1017,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1017',[],'ar'),
                        'en' => trans('errors.1017',[],'en'),
                        'ku' => trans('errors.1017',[],'ku')
                    ]
                ],
                'otp.required' => [
                    'ErrorCode' =>  1027,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1027',[],'ar'),
                        'en' => trans('errors.1027',[],'en'),
                        'ku' => trans('errors.1027',[],'ku')
                    ]
                ]

            ]
        );

        if($validator->fails()){
            $response = array_merge(array_values($validator->errors()->getMessages())[0][0], [
                'Success' => false,
                'response' => []
            ]);
            return Response::make($response);
        }else{
            $user = User::where('phone', $request->phone)->where('verification_code',$request->otp)->first();
            if (!$user) {
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => [
                        'ar' => trans('errors.1028',[],'ar'),
                        'en' => trans('errors.1028',[],'en'),
                        'ku' => trans('errors.1028',[],'ku')
                    ],
                    'ErrorCode' => 1028,
                    'response' => []
                ]);
            }else{
                $user->setRememberToken($token = Str::random(60));
                $user->save();
                return Response::make([
                    'Success' => true,
                    'ErrorMessage' => null,
                    'ErrorCode' => null,
                    'response' => [
                        'token' => $token,
                    ]
                ]);
            }


        }
    }
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required'
        ],
            [
                'password.required' => [
                    'ErrorCode' =>  1007,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1007',[],'ar'),
                        'en' => trans('errors.1007',[],'en'),
                        'ku' => trans('errors.1007',[],'ku')
                    ]
                ],
                'password.string' => [
                    'ErrorCode' =>  1008,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1008',[],'ar'),
                        'en' => trans('errors.1008',[],'en'),
                        'ku' => trans('errors.1008',[],'ku')
                    ]
                ],
                'password.min' => [
                    'string' => [
                        'ErrorCode' =>  1009,
                        'ErrorMessage' =>  [
                            'ar' => trans('errors.1009',[],'ar'),
                            'en' => trans('errors.1009',[],'en'),
                            'ku' => trans('errors.1009',[],'ku')
                        ]
                    ]
                ],
                'password.confirmed' => [
                    'string' => [
                        'ErrorCode' =>  1029,
                        'ErrorMessage' =>  [
                            'ar' => trans('errors.1029',[],'ar'),
                            'en' => trans('errors.1029',[],'en'),
                            'ku' => trans('errors.1029',[],'ku')
                        ]
                    ]
                ],
                'phone.required' => [
                    'ErrorCode' =>  1010,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1010',[],'ar'),
                        'en' => trans('errors.1010',[],'en'),
                        'ku' => trans('errors.1010',[],'ku')
                    ]
                ],
                'phone.min' => [
                    'string' => [
                        'ErrorCode' =>  1011,
                        'ErrorMessage' =>  [
                            'ar' => trans('errors.1011',[],'ar'),
                            'en' => trans('errors.1011',[],'en'),
                            'ku' => trans('errors.1011',[],'ku')
                        ]
                    ]
                ],
                'phone.regex' => [
                    'ErrorCode' =>  1017,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1017',[],'ar'),
                        'en' => trans('errors.1017',[],'en'),
                        'ku' => trans('errors.1017',[],'ku')
                    ]
                ],
                'password_confirmation.required' => [
                    'ErrorCode' =>  1030,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1030',[],'ar'),
                        'en' => trans('errors.1030',[],'en'),
                        'ku' => trans('errors.1030',[],'ku')
                    ]
                ],
                'token.required' => [
                    'ErrorCode' =>  1031,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1031',[],'ar'),
                        'en' => trans('errors.1031',[],'en'),
                        'ku' => trans('errors.1031',[],'ku')
                    ]
                ],

            ]
        );

        if($validator->fails()){
            $response = array_merge(array_values($validator->errors()->getMessages())[0][0], [
                'Success' => false,
                'response' => []
            ]);
            return Response::make($response);
        }
        else{
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => [
                        'ar' => trans('errors.1026',[],'ar'),
                        'en' => trans('errors.1026',[],'en'),
                        'ku' => trans('errors.1026',[],'ku')
                    ],
                    'ErrorCode' => 1026,
                    'response' => []
                ]);
            }
            else{

                if($user->remember_token != $request->token){
                    return Response::make([
                        'Success' => false,
                        'ErrorMessage' => [
                            'ar' => trans('errors.1032',[],'ar'),
                            'en' => trans('errors.1032',[],'en'),
                            'ku' => trans('errors.1032',[],'ku')
                        ],
                        'ErrorCode' => 1032,
                        'response' => []
                    ]);
                }else{
                    $user->forceFill([
                            'password' => Hash::make($request->password)
                        ])->setRememberToken(Str::random(60));
                        $user->save();
                        event(new PasswordReset($user));
                }


//                $status = Password::reset(
//                    $request->only('email', 'password', 'password_confirmation', 'token'),
//                    function ($user, $password) {
//                        $user->forceFill([
//                            'password' => Hash::make($password)
//                        ])->setRememberToken(Str::random(60));
//
//                        $user->save();
//
//                        event(new PasswordReset($user));
//                    }
//                );
//                return $status === Password::PASSWORD_RESET
//                    ? redirect()->route('login')->with('status', __($status))
//                    : back()->withErrors(['email' => [__($status)]]);


                return Response::make([
                    'Success' => true,
                    'ErrorMessage' => null,
                    'ErrorCode' => null,
                    'response' => [
                        'Message'  => 'Password reset successfully'
                    ]
                ]);
            }


        }
    }
    public function resendotp(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ],
            [
                'phone.required' => [
                    'ErrorCode' =>  1010,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1010',[],'ar'),
                        'en' => trans('errors.1010',[],'en'),
                        'ku' => trans('errors.1010',[],'ku')
                    ]
                ],
                'phone.min' => [
                    'string' => [
                        'ErrorCode' =>  1011,
                        'ErrorMessage' =>  [
                            'ar' => trans('errors.1011',[],'ar'),
                            'en' => trans('errors.1011',[],'en'),
                            'ku' => trans('errors.1011',[],'ku')
                        ]
                    ]
                ],
                'phone.regex' => [
                    'ErrorCode' =>  1017,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1017',[],'ar'),
                        'en' => trans('errors.1017',[],'en'),
                        'ku' => trans('errors.1017',[],'ku')
                    ]
                ],

            ]
        );

        if($validator->fails()){
            $response = array_merge(array_values($validator->errors()->getMessages())[0][0], [
                'Success' => false,
                'response' => []
            ]);
            return Response::make($response);
        }
        else{
            $user = User::where('phone', $request->phone)->first();
            if (!$user) {
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => [
                        'ar' => trans('errors.1026',[],'ar'),
                        'en' => trans('errors.1026',[],'en'),
                        'ku' => trans('errors.1026',[],'ku')
                    ],
                    'ErrorCode' => 1026,
                    'response' => []
                ]);
            }else{
//                $verification_code = random_int(1000, 9999);
                $verification_code = '0000';
                $user->verification_code = $verification_code;
                $user->save();

                //Send Otp
//                $otpController = new OTPVerificationController();
//                $otpController->send_code($request->phone,$verification_code);

                return Response::make([
                    'Success' => true,
                    'ErrorMessage' => null,
                    'ErrorCode' => null,
                    'response' => [
                        'otp'=>  $verification_code
                    ]
                ]);
            }


        }
    }
}
