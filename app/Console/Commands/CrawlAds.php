<?php

namespace App\Console\Commands;

use App\User;
use App\Advert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CrawlAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl {uri}';

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

    protected function allowedBy($currentAds, $newAd)
    {
        foreach ($currentAds as $currentAd) 
        {
            // Check if the addresses are similar
            similar_text($currentAd->address, $newAd['address'], $similar);
            
            // If the address match is higher than 90% and the size of the flats are different (Atleast 3 sqm).
            if ($similar >= 90.0 && ($newAd['size'] >= ((int)$currentAd->size)+3 || $newAd['size'] <= ((int)$currentAd->size)-3))
            {
                $adsAllow[] = true;
            }
            elseif ($similar < 90.0) // If the address match is lower than 90%
            {
                $adsAllow[] = true;
            }
            else
            {
                $adsAllow[] = false;
            }
        }

        return (!in_array(false, $adsAllow));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $newAds = getAdverts($this->argument('uri'));

        foreach ($newAds as $newAd)
        {
            $currentAds = Advert::all();

            if (count($currentAds) == 0)
            {
                Advert::create($newAd);
            }
            elseif($this->allowedBy($currentAds, $newAd))
            {
                Advert::create($newAd);
            }
        }

        foreach (Advert::all() as $advert)
        {
            foreach (User::all() as $user) 
            {
                if (!$advert->users->contains($user->id)) 
                {
                    $advert->users()->attach($user->id);
                }
            }
        }
    }
}
