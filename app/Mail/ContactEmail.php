<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * ContactEmail
 * -----------------------
 * Builds a new contact email.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Mail
 */
class ContactEmail extends Mailable {

    use Queueable, SerializesModels;

    private $request;

    /**
     * Creates a new message instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Builds the message.
     *
     * @return $this
     */
    public function build() {
        $email = $this->request->get('email');
        $name = $this->request->get('name');
        $content = $this->request->get('message');

        return $this->from($email, $name)
            ->subject(\Lang::get('email.contact_subject'))
            ->view('emails.contact')
            ->with([
                'email'   => $email,
                'name'    => $name,
                'content' => $content
            ]);
    }
}
