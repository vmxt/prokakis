<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unsubscribe;
use App\CompanyProfile;


class UnsubscribeController extends Controller
{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()
    {

      // $this->middleware('auth');

    }

    public function unsubscribe($user_id)
    { 
        $company = CompanyProfile::find($user_id);

        $notify_type = 'welcome_mail';
        $notify_date = date('Y-m-d');
        $token = $company->id . '-ebos-' . $user_id . '-ebos-' . base64_encode($notify_type) . '-ebos-' . base64_encode($notify_date);

        Unsubscribe::create([ 
            'company_id' => $company->id,
            'user_id' => $user_id,  
            'notify_type' => $notify_type,
            'token' => $token,
            'created_at' => $notify_date, 
        ]);
        
        echo "You have successfully unsubscribe from the alert notification.";
        sleep(5);
        return redirect('home'); 
    }
    

    public function index(Request $request)
    {

        if(isset($request['token'])){

           $token = $request['token'];
           $res = explode("-ebos-",$token);
           //var_dump($res);
           //exit;

           $company_id = base64_decode($res[0]);
           $user_id = base64_decode($res[1]);
           $noti_type = base64_decode($res[2]);
           $date_sent = base64_decode($res[3]);
            
           $rs =  CompanyProfile::where('id', $company_id)->where('user_id', $user_id)->get();
           
           if(count($rs) > 0){

            $datec = date('Y-m-d H:i:s');

            Unsubscribe::create([
                'company_id'    => $company_id, 
                'user_id'       => $user_id, 
                'notify_type'   => $noti_type, 
                'token'         => $token, 
                'created_at'    => $datec, 
                'updated_at'    => $datec,
            ]);
            
            echo "You have successfully unsubscribe from the alert notification.";
            sleep(5);
            return redirect('logout');

           } else {

            echo "Please stop hacking our site, there is nothing in here. ";
            sleep(5);
            return redirect('logout');

           }

        }

    }


}



