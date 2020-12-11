<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;

use App\InOutUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller

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



    public function redirectToProvider()

    {

        return Socialite::driver('facebook')->redirect();

    }



    /**

     * Obtain the user information from GitHub.

     *

     * @return \Illuminate\Http\Response

     */

    public function handleProviderCallback()

    {

        $fb = Socialite::driver('facebook')->user();

        return $fb->name;

    }

    //    InOutUsers::insert_updateDB(array('user_id'=>Auth::id(), 'status'=>0));
    //     Auth::logout();
    public function logout(Request $request)
    {
        InOutUsers::insert_updateDB(array('user_id'=>Auth::id(), 'status'=>0));
        Auth::logout();
        return redirect('/');

    }	



}

