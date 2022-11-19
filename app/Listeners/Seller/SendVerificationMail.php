<?php

namespace App\Listeners\Seller;

use App\Events\Seller\Registered;
use App\Mail\Seller\SellerVerificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {

        if(!empty($event->payload['email']))
        {
           
             Mail::send(new SellerVerificationMail($event->payload));
           
        }
    }
}
