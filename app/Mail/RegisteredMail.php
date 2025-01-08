<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredMail extends Mailable
{
  use Queueable, SerializesModels;

  public $user;

  function __construct($user)
  {
    $this->user = $user;
  }

  public function build()
  {
    return $this->markdown('email.registered_email_mail')
      ->subject('Registered Mail Password Set');
  }

}