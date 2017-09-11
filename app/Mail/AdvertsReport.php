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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $today = \Carbon\Carbon::today();
        $this->uri = url('reports/download', [$today->year, $today->month, $today->day]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Report for ' . \Carbon\Carbon::today()->format('l'))
                    ->view('email.html')
                    ->text('email.text');
    }
}
