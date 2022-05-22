<?php

namespace App\Application\Controllers\Api;

use App\Application\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'first_name' => 'required|max:255',
            // 'last_name' => 'required|max:255',
            'name' => 'required|max:255',
            'mobile' => 'required|max:15',
            // 'specialization' => 'required|max:255',
            'categories' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            // 'g-recaptcha-response' => 'required|recaptcha',

        ]);
    }
    protected function validatorLogin(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'businessName' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:users',
            'businessSize' => 'required|string',
            'userType' => 'required|string|in:seller,customer',
            'country_id' => 'required|integer',
        ],
            [
                'businessName.required' => [
                'ErrorCode' =>  1001,
                'ErrorMessage' =>  [
                    'ar' => trans('errors.1001',[],'ar'),
                    'en' => trans('errors.1001',[],'en'),
                    'ku' => trans('errors.1001',[],'ku')
                ]
            ],
                'businessName.string' => [
                'ErrorCode' =>  1002,
                'ErrorMessage' =>  [
                    'ar' => trans('errors.1002',[],'ar'),
                    'en' => trans('errors.1002',[],'en'),
                    'ku' => trans('errors.1002',[],'ku')
                ]
            ],
                'email.required' => [
                    'ErrorCode' =>  1003,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1003',[],'ar'),
                        'en' => trans('errors.1003',[],'en'),
                        'ku' => trans('errors.1003',[],'ku')
                    ]
                ],
//                'email.email' => [
//                    'ErrorCode' =>  1004,
//                    'ErrorMessage' =>  [
//                        'ar' => trans('errors.1004',[],'ar'),
//                        'en' => trans('errors.1004',[],'en'),
//                        'ku' => trans('errors.1004',[],'ku')
//                    ]
//                ],
                'email.string' => [
                    'ErrorCode' =>  1005,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1005',[],'ar'),
                        'en' => trans('errors.1005',[],'en'),
                        'ku' => trans('errors.1005',[],'ku')
                    ]
                ],
                'email.unique' => [
                    'ErrorCode' =>  1006,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1006',[],'ar'),
                        'en' => trans('errors.1006',[],'en'),
                        'ku' => trans('errors.1006',[],'ku')
                    ]
                ],
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
                'businessSize.required' => [
                    'ErrorCode' =>  1012,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1012',[],'ar'),
                        'en' => trans('errors.1012',[],'en'),
                        'ku' => trans('errors.1012',[],'ku')
                    ]
                ],
                'businessSize.string' => [
                    'ErrorCode' =>  1013,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1013',[],'ar'),
                        'en' => trans('errors.1013',[],'en'),
                        'ku' => trans('errors.1013',[],'ku')
                    ]
                ],
                'userType.required' => [
                    'ErrorCode' =>  1014,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1014',[],'ar'),
                        'en' => trans('errors.1014',[],'en'),
                        'ku' => trans('errors.1014',[],'ku')
                    ]
                ],
                'userType.string' => [
                    'ErrorCode' =>  1015,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1015',[],'ar'),
                        'en' => trans('errors.1015',[],'en'),
                        'ku' => trans('errors.1015',[],'ku')
                    ]
                ],
                'userType.in' => [
                    'ErrorCode' =>  1016,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1016',[],'ar'),
                        'en' => trans('errors.1016',[],'en'),
                        'ku' => trans('errors.1016',[],'ku')
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
                'country_id.integer' => [
                    'ErrorCode' =>  1020,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1020',[],'ar'),
                        'en' => trans('errors.1020',[],'en'),
                        'ku' => trans('errors.1020',[],'ku')
                    ]
                ],
                'country_id.required' => [
                    'ErrorCode' =>  1021,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1021',[],'ar'),
                        'en' => trans('errors.1021',[],'en'),
                        'ku' => trans('errors.1021',[],'ku')
                    ]
                ],
                'phone.unique' => [
                    'ErrorCode' =>  1022,
                    'ErrorMessage' =>  [
                        'ar' => trans('errors.1022',[],'ar'),
                        'en' => trans('errors.1022',[],'en'),
                        'ku' => trans('errors.1022',[],'ku')
                    ]
                ],

            ]
        );
//dd($validator->errors());
        if($validator->fails()){
            if(is_array(array_values($validator->errors()->getMessages())[0][0])){
                $response = array_merge(array_values($validator->errors()->getMessages())[0][0], [
                    'Success' => false,
                    'response' => []
                ]);
                return Response::make($response);
            }else{
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => array_values($validator->errors()->getMessages())[0][0],
                    'ErrorCode' => null,
                    'response' => []
                ]);
            }
        }else{
//            $verification_code = random_int(1000, 9999);
            $verification_code = '0000';
            $user = User::create([
                'name' => $request->businessName,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'user_type' => $request->userType,
                'verification_code' => $verification_code,
                'country_id' => $request->country_id,
            ]);

            if ($request->userType == User::SELLER_TYPE) {
                Sellers::create([
                    'user_id' => $user->id,
                ]);
            }
            else {
                Customers::create([
                    'user_id' => $user->id,
                    'business_size' => $request->business_size,
                ]);
            }
            //Send Otp
            $otpController = new OTPVerificationController();
            $otpController->send_code($request->phone,$verification_code);
        }
        $user = User::find($user->id);
        if($user){
            return Response::make([
                'Success' => true,
                'ErrorMessage' => null,
                'ErrorCode' => null,
                'response' => (array (new UserCollection([$user]))[0])
            ]);
        }

    }
    public function login(Request $request){


        $this->validatorLogin($request->all())->validate();

//dd(222);
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'email' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
        ],[
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
            if(is_array(array_values($validator->errors()->getMessages())[0][0])){
                $response = array_merge(array_values($validator->errors()->getMessages())[0][0], [
                    'Success' => false,
                    'response' => []
                ]);
                return Response::make($response);
            }else{
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => array_values($validator->errors()->getMessages())[0][0],
                    'ErrorCode' => null,
                    'response' => []
                ]);
            }
        }else{
            $user = User::where('phone', $request->phone)->first();
            if (!$user || !Hash::check($request['password'], $user->password)) {
                return Response::make([
                    'Success' => false,
                    'ErrorMessage' => [
                        'ar' => trans('errors.1019',[],'ar'),
                        'en' => trans('errors.1019',[],'en'),
                        'ku' => trans('errors.1019',[],'ku')
                    ],
                    'ErrorCode' => 1019,
                    'response' => []
                ]);
            }else{
                if($user->banned == 1){
                    return Response::make([
                        'Success' => false,
                        'ErrorMessage' => [
                            'ar' => trans('errors.1033',[],'ar'),
                            'en' => trans('errors.1033',[],'en'),
                            'ku' => trans('errors.1033',[],'ku')
                        ],
                        'ErrorCode' => 1033,
                        'response' => []
                    ]);
                }
                if($user->customer){
                    if($user->customer->is_active == 0){
                        return Response::make([
                            'Success' => false,
                            'ErrorMessage' => [
                                'ar' => trans('errors.1023',[],'ar'),
                                'en' => trans('errors.1023',[],'en'),
                                'ku' => trans('errors.1023',[],'ku')
                            ],
                            'ErrorCode' => 1023,
                            'response' => []
                        ]);
                    }
                    elseif ($user->customer->is_verified == 0){
                        return Response::make([
                            'Success' => false,
                            'ErrorMessage' => [
                                'ar' => trans('errors.1024',[],'ar'),
                                'en' => trans('errors.1024',[],'en'),
                                'ku' => trans('errors.1024',[],'ku')
                            ],
                            'ErrorCode' => 1024,
                            'response' => []
                        ]);

                    }
                    elseif ($user->customer->is_deleted == 1){
                        return Response::make([
                            'Success' => false,
                            'ErrorMessage' => [
                                'ar' => trans('errors.1025',[],'ar'),
                                'en' => trans('errors.1025',[],'en'),
                                'ku' => trans('errors.1025',[],'ku')
                            ],
                            'ErrorCode' => 1025,
                            'response' => []
                        ]);

                    }
                }

                return Response::make([
                    'Success' => true,
                    'ErrorMessage' => null,
                    'ErrorCode' => null,
                    'response' => (array (new UserCollection([$user]))[0])
                ]);
            }

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
