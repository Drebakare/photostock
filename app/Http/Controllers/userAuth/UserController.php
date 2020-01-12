<?php
namespace App\Http\Controllers\userAuth;

use App\Http\Controllers\Controller;
use App\Photo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Category;
use App\Mail\verifyEmail;

use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;


//use App\Mail\verifyEmail;



class UserController extends Controller
{
    public function register(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'accountType' => 'bail|required',
                'email' => 'bail|required|unique:users',
                'fullname' => 'bail|required',
                'password' => 'bail|required|confirmed',
            ]);

            if ($request->accountType == 'buyer') {
                $new_user = User::create([
                    'name' => $request->Fullname,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'is_seller' => 0,
                ]);
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $response = array(
                        'status' => true,
                        'message' => 'Data is successfully added'
                    );
                    return response()->json($response);
                } else {
                    $response = array(
                        'status' => false,
                        'msg' => 'error'
                    );
                    return response()->json($response);
                }
            } else {
                $response = array(
                    'status' => false,
                    'msg' => 'error'
                );
                return response()->json($response);
            }
        }

        else {
            $user_data = $request;

            $validation = $this->validate($user_data, [
                'fullname' => 'bail|required|max:100 ',
                'email' => 'bail|required|email',
                'password' => 'bail|required|min:8|confirmed'
            ]);
            $confirm = User::where('email', '=', $user_data->email)->get();

            if (count($confirm) == 0) {
                if (($request->accountType) == 'buyer') {
                    if ($validation) {
                        if ($user_data->password == $user_data->password_confirmation) {
                            $new_user = User::create([
                                'name' => $user_data->fullname,
                                'email' => $user_data->email,
                                'password' => bcrypt($user_data->password),
                                'is_seller' => 0,
                            ]);
                            return redirect()->back()->with('success', 'you have been successfully registered, you can login');
                        }
                        else {
                            return redirect()->back()->with('failure', 'The passwords do not match');
                        }


                    }

                }
                else {
                    if ($validation) {
                        if ($user_data->password == $user_data->password_confirmation) {

                            $new_user = User::create([
                                'name' => $user_data->fullname,
                                'email' => $user_data->email,
                                'is_seller' => 1,
                                'password' => bcrypt($user_data->password),
                                'token' => Str::random(40),
                            ]);

                            if ($new_user) {
                                $thisUser = User::findorfail($new_user->id);
                                $this->sendEmail($thisUser);
                                return redirect()->back()->with('success', 'you have been successfully registered, Verify email to activate account');
                            }

                        } else {
                            return redirect()->back()->with('failure', 'The passwords do not match');
                        }

//
                    }
                }

            } else {
                return redirect()->back()->with('failure', 'email already exist');
            }
        }
    }
    public function sendEmail($thisUser){
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function confirm($token){
        $activated_user = User::where('token', '=',$token)->first();
        if($activated_user){
            User::where(['token'=>$token])->update(['is_activated'=>1,'is_seller'=>1,'remember_token'=>$token,'token'=>null, 'email_verified_at'=> date("Y-m-d h:i:s")]);
            return redirect('/')->with('success','Your account has been activated you can now log in');
        }

    }

    public function login(Request $request)
    {
        if((new \Illuminate\Http\Request)->ajax()){
            try{
                $this->validate($request, [
                    'email' => 'bail|required',
                    'password' =>'bail|required'
                ]);
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $response = array(
                        'status' => true,
                        'message' => 'Data is successfully added'
                    );
                    return response()->json($response);
                }
                else {
                    $response = array(
                        'status' => false,
                        'msg' => 'error'
                    );
                    return response()->json($response);
                }

            }
            catch (ValidationException $exception){
                return response()->json(['failure'=>$exception->validator->errors()->first()]);
            }
            catch (\Exception $exception){
                return response()->json(['failure'=>$exception->getMessage()]);
            }
        }
        else{
            $user_data = $request;
            $validation = $this->validate($user_data, [
                'email' => 'required|email',
                'password' => 'required|min:3'
            ]);

            if ($validation) {
                $confirm = User::where('email', '=', $user_data->email)->first();
                if($confirm){
                    $checkSeller = $confirm->is_seller;;
                    $checkActivation = $confirm->is_activated;;
                    $checkAdmin = $confirm->is_admin;
                    if (($checkSeller == 0) && ($checkAdmin == 1)) {
                        if (Auth::attempt(['email' => $user_data->email, 'password' => $user_data->password])) {
                            return redirect(route('admin.dashboard'));
                        } else {
                            return redirect()->back()->with('failure', 'username or password incorrect');
                        }
                    }
                    elseif (($checkSeller == 1))
                    {

                        if ($checkActivation == 1) {

                            if (Auth::attempt(['email' => $user_data->email, 'password' => $user_data->password])) {
                                return redirect(route('homepage'));

                            }
                            else {
                                return redirect()->back()->with('failure', 'username or password incorrect');
                            }
                        }
                        else{

                            return redirect()->back()->with('failure', 'Your email is not activated yet, kindly activate your email');

                        }
                    } else {
                        if (Auth::attempt(['email' => $user_data->email, 'password' => $user_data->password])) {
                            return redirect('/');
                        }
                        else {
                            return redirect()->back()->with('failure', 'username or password incorrect');
                        }
                    }
                }
                else{
                    return redirect()->back()->with('failure', 'You are not a registered member, kindly register to kick start');
                }



            }
        }



    }
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }


    public function handleProviderCallback($social)
    {
        $social_user = Socialite::driver($social)->stateless()->user();

        if($social_user->email){
            $confirm = User::where('email', '=', $social_user->email)->first();

            if(!($confirm)){
                $new_user = User::create([
                    'name' => $social_user->name,
                    'email' => $social_user->email,
                    'password' => bcrypt(''),
                ]);
            }
            $new_confirm=User::where('email', '=', $social_user->email)->first();
            $login=Auth::loginUsingId($new_confirm->id);
            if($login){
                return redirect('/');
            }
            else{
                return redirect('/')->with('failure', 'username or password incorrect');
            }

        }
        else{
            return redirect('/')->with('failure', 'Your email is needed to sign in');
        }


    }

    public function checkoutLogin(Request $request){

    }
}



