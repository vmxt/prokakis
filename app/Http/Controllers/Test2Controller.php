<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\CompanyProfile;

use App\UploadImages;

use App\BrandSlogan;

use App\WhoViewedMe;

use Auth;



use Config;

use Session;

use App\BusinessOpportunitiesNews;

use App\RegistrationLinks;

use App\Mailbox; 

use App\Console\Commands\thomsonReutersWorldUpdate;

class Test2Controller extends Controller

{

    

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

       //$this->middleware('auth');

    }

    public function getWorldData()
    {
        $rs = new thomsonReutersWorldUpdate;
        $rs->handle();
    }

    

    public function index(Request $request)

    {

        $data = file_get_contents("http://app-prokakis.com/public/emailtemplate/ProkakisEnhanceProfile.html");

    
        $data = str_replace("[First Name]", "Test Victor", $data);
        $data = str_replace("[Company Name]", "Test Company", $data);

        $en_company_id = base64_encode(62);
        $en_user_id = base64_encode(31);
        $en_notify_type = base64_encode('enhancedprofile');
        $en_notify_date = base64_encode(date('Y-m-d'));
        $token = $en_company_id.'-ebos-'.$en_user_id.'-ebos-'. $en_notify_type.'-ebos-'.$en_notify_date;
        echo $token .'<br />';

        $url_token = url('/unsubscribeMe/'.$token); 

        echo $url_token .'<br />';

        //exit;
        
        $data = str_replace("[UNSUBSCRIBE LINK]", $url_token, $data);

        $this->alertNotify($data, 'vicsaints3rd@gmail.com', 'Enhance Company Profile, Prokakis');  

    }



    

    public function alertNotify($message, $email, $messageTitle)

    {

        //send the email here  

        Mailbox::sendMail_EmailTemplate($message, $email, $messageTitle, ""); 

    }







    

 

   

    

}



