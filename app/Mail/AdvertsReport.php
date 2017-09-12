<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvertsReport extends Mailable
{
    use Queueable, SerializesModels;

    public $uri;

    public $today;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->today = \Carbon\Carbon::today();
        $this->uri = url('reports', [$this->today->year, $this->today->month, $this->today->day]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Report for ' . $this->today->format('l'))
                    ->view('email.html')
                    ->text('email.text');
    }
}
