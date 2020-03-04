<?php



namespace App\Console\Commands;



use App\CompanyProfile;

use Illuminate\Console\Command;





class alertEnhanceProfile extends Command

{



    protected $signature = 'alertEnhanceProfile:prokakis';





     /**

     * The console command description.

     *

     * @var string

     */

    protected $description = 'To alert companies with profile completeness less than 50 percents';



     /**

     * Create a new command instance.

     *

     * @return void

     */

    public function __construct()

    {

        parent::__construct();

    }



    /**

     * Execute the console command.

     *

     * @return mixed

     */

    public function handle()

    {

        echo "Start ..."."\n";

        $Url = "https://app.prokakis.com/testMail72AE25495A7981C40622D49F9A52E4F1565C90F048F59027BD9C8C8900D5C3D8"; 

        $ch = curl_init();



		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_URL, $Url);

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		curl_setopt($ch, CURLOPT_VERBOSE, 0);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_exec($ch);

		curl_close($ch);



        echo "Done ..."."\n";

    }



  





 



}



