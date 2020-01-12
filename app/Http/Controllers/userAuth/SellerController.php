<?php
namespace App\Http\Controllers\userAuth;

use App\Http\Controllers\Controller;
use App\Photo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\verifyEmail;




class SellerController extends Controller
{
    public function register(Request $request){
        $user_data = $request;

        $validation = $this->validate($user_data,[
            'Fullname'=>'required|max:100 ',
            'email'=>'required|email',
            'password'=>'required|min:3'
        ]);
        $confirm = User::where('email', '=',$user_data->email)->get();

        if(count($confirm)==0){
            if($validation){
                if($user_data->password==$user_data->confirmPassword){
                    $new_user = user::create([
                        'name' => $user_data->Fullname,
                        'email' => $user_data->email,
                        'is_seller'=>1,
                        'password' =>bcrypt($user_data->password),
                        'token' =>Str::random(40),
                    ]);
                    if($new_user){
                        $thisUser= User::findorfail($new_user->id);
                        $this->sendEmail($thisUser);
                        return redirect('/newSeller')->with('success', 'you have been successfully registered, Verify email to activate account');
                    }

                }
                else{
                    return redirect('/newSeller')->with('failure','The passwords do not match');
                }

//
            }
        }
        else{
            return redirect('/newSeller')->with('failure', 'email already exist');
        }

    }
    public function sendEmail($thisUser){
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function confirm($token){
        $activated_user = User::where('token', '=',$token)->first();
        if($activated_user){
            User::where(['token'=>$token])->update(['is_activated'=>1,'is_seller'=>1,'remember_token'=>$token,'token'=>null, 'email_verified_at'=> date("Y-m-d h:i:s")]);
            return redirect(route("signup"))->with('success','Your account has been activated you can now log in');
        }

    }
}
