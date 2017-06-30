<?php

namespace App\Mail;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * TestEmail
 * -----------------------
 * Builds a new email to test the email settings..
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Mail
 */
class TestEmail extends Mailable {

    use Queueable, SerializesModels;

    /**
     * Builds the message.
     *
     * @return $this
     */
    public function build() {
        return $this
            ->subject(trans('email.test.subject', ['title' => \Settings::pageTitle()]))
            ->markdown('emails.test', [
                'link' => route('home')
            ]);
    }
}
