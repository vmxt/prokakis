<?php

namespace App\Console\Commands;

use App\CompanyProfile;
use Illuminate\Console\Command;

use DB;

use App\Mailbox; 

use App\RequestReport;

class fileSync extends Command
{

    protected $signature = 'fileSync:prokakis';


     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To sync images from TMD to HostPapa';

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
    

        echo "Sending of email notification finished.. \n";
        echo "Done ..."."\n";
    }

}

