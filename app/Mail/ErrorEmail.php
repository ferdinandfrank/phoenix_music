<?php

namespace App\Mail;

use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * ErrorEmail
 * -----------------------
 * Builds a new error email.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Mail
 */
class ErrorEmail extends Mailable {

    use Queueable, SerializesModels;

    /**
     * The error of the ErrorEmail.
     *
     * @var \Exception
     */
    private $error;

    private $extraInfo;

    /**
     * Creates a new message instance.
     *
     * @param \Exception $error
     * @param array      $extraInfo
     */
    public function __construct(\Exception $error, array $extraInfo = null) {
        $this->error = $error;
        $this->extraInfo = $extraInfo;
    }

    /**
     * Builds the message.
     *
     * @return $this
     */
    public function build() {
        $subject = \Lang::get('email.error.subject', ['title' => Settings::pageTitle()]);
        $errorContent = $this->error->getFile() . '(' . $this->error->getLine() . '): ' . $this->error->getMessage();
        $introLines = array_merge([trans('email.error.content'), $errorContent], $this->extraInfo);

        return $this
            ->subject($subject)
            ->markdown('emails.error', [
                'introLines' => $introLines,
                'actionText' => trans('action.to_website'),
                'actionUrl' => route('admin')
            ]);
    }
}
