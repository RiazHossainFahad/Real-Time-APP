<?php

namespace App\Listeners;

use App\Events\ReplyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReplyEventListener
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
     * @param  ReplyEvent  $event
     * @return void
     */
    public function handle(ReplyEvent $event)
    {
        //
    }
}
