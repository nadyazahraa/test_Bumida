<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastLoginAt
{
    // Create event listener
    public function __construct()
    {
        //
    }

    // Handle the event
    public function handle(Authenticated $event)
    {
        $event->user->update([
            'last_login_at' => Carbon::now(),
        ]);
    }
}
