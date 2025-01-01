<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComposeEmailMail extends Mailable
{
  use Queueable, SerializesModels;

  public $compose;

  function __construct($compose)
  {
    $this->compose = $compose;
  }

  public function build()
  {
    return $this->markdown('email.compose_email_mail')
      ->subject($this->compose->subject);
  }

}