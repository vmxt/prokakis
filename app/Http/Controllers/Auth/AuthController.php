<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

use Auth;

use Illuminate\Http\Request;
use App\User;
use App\CoreLoginHistory;
use App\UserHistory;
use Carbon\Carbon;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {

       $credentials = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 1
        );

        if ( Auth::attempt($credentials)) 
        {
            $user = User::find(Auth::id());
            if($user->user_type == 2 || $user->user_type == 3 || $user->user_type == 4 || $user->user_type == 5){
                  $data = [
                    'event'      => "Logged In",
                    'url'        => request()->fullUrl(),
                    'ip_address' => request()->getClientIp(),
                    'user_agent' => request()->userAgent(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'user_id'    => Auth::id(),
                    'user_email'    => $user->email
                ];
                $details = CoreLoginHistory::create($data);
            }
            else{
                $data = [
                    'event'      => "Logged In",
                    'url'        => request()->fullUrl(),
                    'ip_address' => request()->getClientIp(),
                    'user_agent' => request()->userAgent(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'user_id'    => Auth::id(),
                    'user_email'    => $user->email
                ];
                $details = UserHistory::create($data);
            }
                return redirect()->intended('home');
        }
        else
        {
            return redirect('/login')->with('status', 'Wrong Credentials!');
        }
    }



}
