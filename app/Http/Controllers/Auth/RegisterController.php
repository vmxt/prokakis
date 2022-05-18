<?php



namespace App\Http\Controllers\Auth;



use App\User;

use App\CompanyProfile;

use App\BrandSlogan;

use App\CompanyBilling;

use App\CompanyContacts;

use App\CompanyPayment;

use App\CompanySocialAccounts;

use App\CurrencyAccounts;



use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

use Illuminate\Foundation\Auth\RegistersUsers;

use App\Mailbox; 

use Illuminate\Validation\ValidationException;

class RegisterController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Register Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users as well as their

    | validation and creation. By default this controller uses a trait to

    | provide this functionality without requiring any additional code.

    |

    */



    use RegistersUsers;



    /**

     * Where to redirect users after registration.

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

        $this->middleware('guest');

    }



    /**

     * Get a validator for an incoming registration request.

     *

     * @param  array  $data

     * @return \Illuminate\Contracts\Validation\Validator

     */

    protected function validator(array $data)

    {

        return Validator::make($data, [

            'firstname' => 'required|string|max:255',

            'lastname' => 'required|string|max:255',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:6|confirmed',

            'company_name' => 'required|string|max:255',

            'company_website' => 'required|string|max:255',

            'user_type' => 'required|string|max:255',

            'tnc' => 'required',

        ], ['tnc.required'=>'Terms and Conditions is required']);

    }



    /**

     * Create a new user instance after a valid registration.

     *

     * @param  array  $data

     * @return \App\User

     */

    protected function create(array $data)
    {
      //var_dump($data); exit;    

      $user_status = "1";

      $referralId = (isset($data['referral_id']))? $data['referral_id'] : null;

      $m_id = (isset($data['m_id']))? $data['m_id'] : null;
      
      if($m_id != null){
        $m_id = (int) base64_decode($m_id);
      } 

      /*if($data['user_type'] == 2 || $data['user_type'] == 3 || $data['user_type'] == 4){

        $user_status = 2;  //2 for approval

      } else{

        $user_status = 1;  //1 for companies 

      } */
      
        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            throw ValidationException::withMessages(['tnc' => 'Security Code is incorrect']);
        } 



      $userResult = User::create([

            'firstname' => $data['firstname'],

            'lastname' => $data['lastname'],

            'email' => $data['email'],

            'password' => bcrypt($data['password']),

            'phone'    =>  $data['phone'],

            'company_name' => $data['company_name'],

            'registered_company_name' => $data['company_name'],

            'company_website' => $data['company_website'],

            'activation_code' => str_random(30).time(),

            'user_type' => $data['user_type'],

            'status' => $user_status,

            'referral_id' => $referralId,
            
            'm_id' => $m_id,

        ]);



      $company_result =  CompanyProfile::create([

            'user_id' => $userResult->id,

            'company_name' => $data['company_name'],

            'company_website' => $data['company_website'],

            'added_by' => $userResult->id,

            'status' => '1',

        ]);

       

        BrandSlogan::create([

            'user_id'=>$userResult->id,

            'company_id'=>$company_result->id,

        ]);

        CompanyBilling::create([

          'user_id'=>$userResult->id,

          'company_id'=>$company_result->id, 

          'added_by'=>$userResult->id,

        ]);

        CompanyContacts::create([

          'user_id'=>$userResult->id,

          'company_id'=>$company_result->id, 

          'added_by'=>$userResult->id, 

        ]);

        CompanySocialAccounts::create([

          'user_id'=>$userResult->id,

          'company_id'=>$company_result->id, 

          'added_by'=>$userResult->id, 

        ]);
        
        // below are the added codes for default user's currency
        CurrencyAccounts::create([

          'user_id'=>$userResult->id,

          'currency_id'=>"3", 

          'updated_at'=>date("Y"), 
          
          'created_at'=>date("Y"), 

        ]);
        
        $appurl = env('APP_URL');
        
//http://app-prokakis.com/public/emailtemplate/welcome_final_edited.html
    //trigger an email for the welcome
    
        $message =  file_get_contents($appurl . "public/emailtemplate/welcome_final_edited.html");
        $message = str_replace("[_firstname_]", $data['firstname'], $message); 
        $message = str_replace("[appurl]", $appurl, $message);
        $message = str_replace("[_unsubscribelink_]", $appurl . "unsubscribe/" . $userResult->id, $message);
        //send the email here  
 
        
        
        Mailbox::sendMail_EmailTemplate($message, $data['email'], "Welcome to Intellinz", "");   

        return $userResult;

        

    }

}

