<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
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
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $mailData['to'] = $event->to;
        $mailData['subject'] = $event->subject;
        $mailData['body'] = $event->body;

        Mail::send('email.mail_template', $mailData, function($message) use ($mailData) {
            $message->to($mailData['to']);
            $message->subject($mailData['subject']);
        });

    }
}
