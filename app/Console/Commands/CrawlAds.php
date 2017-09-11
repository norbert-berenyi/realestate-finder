<?php

namespace App\Console\Commands;

use App\Advert;
use Illuminate\Console\Command;

class CrawlAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl {ads}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawls ingatlan.com adverts.';

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
        $uri = $this->argument('ads');
        $ads = getAdverts($uri);

        foreach ($ads as $ad)
        {
            Advert::firstOrCreate(['address' => $ad['address'], 'size' => $ad['size']], $ad);
        }
    }
}
