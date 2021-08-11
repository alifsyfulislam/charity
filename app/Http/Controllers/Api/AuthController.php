<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    protected $userRepository;


    /**
     * AuthController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;

    }


    public function __invoke(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [

            'username'=>'required',
            'password' => 'required'

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status_code' => 400,
                'messages'    => config('status.status_code.400'),
                'errors'      => $validator->messages()->all()
            ]);

        } else {

            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if(Auth::attempt(array($fieldType => $input['username'], 'password' => $input['password'])) )
            {
                $user = Auth::user();

                $userInfo = $this->userRepository->show($user->id);

                $success['status_code'] = 200;
                $success['messages']    = config('status.status_code.200');
                $success['token']       = $user->createToken('Charity')->accessToken;
                $success['user_info']   = $userInfo;

                return response()->json($success);

//                if (Auth::user()->can('admin-panel')){
//                    return response()->json($success);
//                }else{
//                    $success['status_code'] = 401;
//                    $success['messages'] = config('status.status_code.401');
//                    return response()->json($success);
//                }
            } else {
                $success['status_code'] = 451;
                $success['messages'] = config('status.status_code.451');
                return response()->json($success);
            }

        }

    }
}
