<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Alert;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginRegister(){
        return view('frontend.user.login-register');
    }


    public function register(Request $request){
        Session::forget('success_message');
        Session::forget('error_message');
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
            $user->status   = 0;
            $user->save();

            $email =  $request->email;
            $messageData = [
                 'email' =>  $request->email,
                 'name'  =>  $request->name,
                 'code' =>  base64_encode($request->email),
            ];

            Mail::send('frontend.emails.confirmation', $messageData, function($message) use($email){
                 $message->to($email)->subject('confirm your e-comerce account');
            });

            $message = 'Please confirm your email to activate your account !';
            Session::put('success_message',$message);
            return redirect()->back();
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
        Session::forget('success_message');
        Session::forget('error_message');
        $credentails = $request->only('email','password');
        if(Auth::attempt($credentails)){

            $userStatus = User::where('email',$request->email)->first();
            if($userStatus->status == 0){
              Auth::logout();
              $message = " Your account is not activated yet! Please confirm your email to activate!";
              Session::put('error_message',$message);
              return redirect()->back();
            }

            if(!empty(Session::get('session_id'))){
                $user_id    = Auth::user()->id;
                $session_id = Session::get('session_id');
                Cart::where('session_id',$session_id)->update(['user_id' =>  $user_id]);
            }
           return redirect()->route('checkout');
        }else{
           Alert::error('Sorry!', 'Invalid Email or Password');
           return redirect()->back();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
