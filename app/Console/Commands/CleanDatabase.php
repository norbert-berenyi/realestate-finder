<?php

namespace App\Console\Commands;

use App\Advert;
use Illuminate\Console\Command;

class CleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans up old database records.';

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
        $adverts = Advert::where('created_at', '<', \Carbon\Carbon::now()->addDays(30))->get();

        foreach ($adverts as $advert)
        {
            foreach ($advert->users as $user)
            {
                $deletable = false;

                if ($user->pivot->seen == true && $user->pivot->promising == false)
                {
                    $deletable = true;
                }

                if ($deletable)
                {
                    $advert->delete();
                }
            }
        }
    }
}
