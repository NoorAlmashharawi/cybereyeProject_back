<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    


    public function showLogin($guard){
           return  response()->view('cms.auth.login',compact('guard'));
    }

    public function login(Request  $request ){
        $validator = Validator($request ->all(),[
            'email' => 'required|string|exists:user1s,email',
            'password' => 'required|min:3'
        ]);

        $credentials = [
            'email'=> $request->get('email'),
            'password' =>$request->get('password')
        ];
       if(! $validator->fails()){
            if(Auth::guard($request->get('guard'))->attempt($credentials)){
                return response()->json([
                    'icon'=>'success',
                    'title' => 'login is successfully'
                ],200);
            }else{
                return response()->json([
                    'icon'=>'error',
                    'title' => 'login is faild'
                ],400);
            }
        }else{
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getmessageBag()->first()
            ],400);
        }
    }

    public function logout(Request  $request){
        $guard = auth('admin')->check() ? 'admin':'student';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('view.login', $guard);
    }

    public function changePassword(){
        
    }

    public function resetPassword(Request $request){
        
    }

    public function editProfile(){
        
    }

    public function updateProfile(Request $request, $id ){
        
    }
}
