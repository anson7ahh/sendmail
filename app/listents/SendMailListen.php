<?php

namespace App\listents;

use App\Models\User;
use App\events\SendMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailListen
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMailEvent $event): void
    {
        $user = User::findorfail($event->user_id)->toArray();

        Mail::send('layouts.mails.mail', $user, function ($massage) use ($user) {
            $massage->to($user['email']);
            $massage->subject('mail');
        });
    }
}
