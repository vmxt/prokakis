<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
Use Exception;

use DB;
use Carbon\Carbon;

use App\ChatHistory; 
use App\ChatHistoryHead; 

class autoArchivingChatMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'autoArchivingChatMessages:prokakis';

    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'Auto Archive Chat messages that is more than 2 motnhs old';

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
        echo "\nstart udpating chat head ..."."\n";

        ChatHistoryHead::where('created_at', '<=', Carbon::now()->subMonths(2))->update(['is_deleted' => 1]);

        echo "\nend udpating chat head ..."."\n";

        echo "\nstart udpating chat messages ..."."\n";

        ChatHistory::where('created_at', '<=', Carbon::now()->subMonths(2))->update(['is_deleted' => 1]);

        echo "\nend udpating chat messages ..."."\n";


    }
}
