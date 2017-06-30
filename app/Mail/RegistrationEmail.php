<?php

namespace App\Mail;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * RegistrationEmail
 * -----------------------
 * Builds a new email to inform an user about his registration.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Mail
 */
class RegistrationEmail extends Mailable {

    use Queueable, SerializesModels;

    private $user;
    private $password;

    /**
     * Creates a new message instance.
     *
     * @param User $user
     * @param      $password
     */
    public function __construct(User $user, $password) {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Builds the message.
     *
     * @return $this
     */
    public function build() {

        return $this
            ->subject(trans('email.registration.subject', ['name' => Settings::pageTitle()]))
            ->markdown('emails.registration', [
                'receiver'   => $this->user->name,
                'user'       => $this->user,
                'password'   => $this->password,
                'introLines' => [trans('email.registration.content', ['name' => Settings::pageTitle()])],
                'actionText' => trans('action.login'),
                'actionUrl'  => route('login.show')
            ]);
    }
}
