<?php namespace Larabook;

use Illuminate\Mail\Mailer as Mail;
abstract class Mailer {


    private $mail;


    function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param $user
     * @param $subject
     * @param $view
     * @param $data
     */
    public function sendTo($user, $subject, $view)
    {
        $this->mail->queue($view, $data, function($message) use($user, $subject){
            $message->to($user->email)->subject($subject);
        });
    }

} 