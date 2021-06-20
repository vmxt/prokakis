<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\CompanyProfile;

use App\UploadImages;

use App\BrandSlogan;

use App\WhoViewedMe;

use Auth;

use Mail;


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
      //  $rs = new thomsonReutersWorldUpdate;
      //  $rs->handle();
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
    
    public function testMailSending(Request $request){
      echo 'test mail sending <br />';

      $emailAdd = "daryl3120@gmail.com";
      //$to = 'darylyrad.cabz@gmail.com';
      $ok = Mailbox::sendMail_EmailTemplate('Email sending test Vic123456', $emailAdd, 'checkTest', ''); 

    //  $data = array('name'=>"Virat Gandhi");
   /*
      $ok = Mail::send(['text'=>'mailbox/samplemail'], $data, function($message) {
          $message->to('darylyrad.cabz@gmail.com', 'Tutorials Point')->subject
             ('Laravel Basic Testing Mail');
          $message->from('support@app-prokakis.com','Virat Gandhi');
       });
  */


      var_dump($ok);
      echo "---";
          if($ok){
               echo 'sent to '.$emailAdd; 
          } else {
              echo 'fail to send '.$emailAdd;
          }
          
    
      
      
    /*$sender = 'support@app-prokakis.com';
    $recipient = 'vic_snts@yahoo.com';
    
    $subject = "php mail test Victor";
    $message = "php test message, the server side mail system is working properly check check";
    $headers = 'From:' . $sender;
    
    if (mail($recipient, $subject, $message, $headers))
    {
        echo "Message sent to $recipient ";
    }
    else
    {
        echo "Error: Message not accepted";
    }
     */     
      
      
    }







    

 

   

    

}


