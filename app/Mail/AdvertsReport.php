<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvertsReport extends Mailable
{
    use Queueable, SerializesModels;

    public $numberOfNewAds;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($numberOfNewAds)
    {
        $this->numberOfNewAds = $numberOfNewAds;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You found ' . $this->numberOfNewAds . ' new ads!')
                    ->view('email.html')
                    ->text('email.text');
    }
}
