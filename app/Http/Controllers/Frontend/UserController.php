<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginRegister(){
        return view('frontend.user.login-register');
    }


    public function register(Request $request){
        $checkEmail = User::where('email',$request->email)->count();

        if($checkEmail > 0){
           $message = "Email already exits";
           Session::flash('error_message',$message);
           return redirect()->back();
        }else{
            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            
            $credentails = $request->only('email','password');
            if(Auth::attempt($credentails)){
              Alert::success('Success', 'USer registration successfully');
               return redirect()->route('checkout');
            }
        }
      
    }

    public function checkEmail(Request $request){
         
        $checkEmail = User::where('email',$request->email)->count();

        if($checkEmail > 0){
            return "false";
        }else{
            return "true";
        }
    }
    
    public function login(Request $request){
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
