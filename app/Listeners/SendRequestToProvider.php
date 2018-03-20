<?php

namespace App\Listeners;

use App\Events\RequestSocialLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequestToProvider
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
     * @param  RequestSocialLogin  $event
     * @return void
     */
    public function handle(RequestSocialLogin $event)
    {
        //
    }
}
