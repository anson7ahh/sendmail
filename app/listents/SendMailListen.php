<?php

namespace App\listents;

use App\Models\User;
use App\events\SendMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;


class SendMailListen  extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
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
    public function handle(SendMailEvent $event)
    {
        $user = User::find($event->user)->toArray();

        return Mail::queue('layouts.mails.mail',  compact('user'), function ($massage) use ($user) {


            $massage->to(($user[0]['email']));

            $massage->subject('welcome ');
        });
    }
}
