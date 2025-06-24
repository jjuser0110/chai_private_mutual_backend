<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputOption;
use Carbon\Carbon;
use Mail;
use App\Models\ProductCategory;

class ChangePinCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changepincategory:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Change Pin Category';

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
     * @return int
     */
    public function handle()
    {
        $all_category = ProductCategory::all();
        foreach($all_category as $category){
            $category->update([
                'password' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT)
            ]);
        }
    }
}
