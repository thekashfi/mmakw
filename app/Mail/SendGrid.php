<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendGrid extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
         $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_from      = $this->data['email_from'];
		$email_from_name = $this->data['email_from_name'];
		
		//$email_cc        = $this->data['email_cc'];
		//$email_cc_name   = $this->data['email_cc_name'];
		
		//$email_bcc       = $this->data['email_bcc'];
		//$email_bcc_name  = $this->data['email_bcc_name'];
		//
		//$email_replyto      = $this->data['email_replyto'];
		//$email_replyto_name = $this->data['email_replyto_name'];
		
        $subject = $this->data['subject'];
        
        return $this->view('emails.template')
                    ->from($email_from,$email_from_name)
                    ->subject($subject)
                    ->with(['email_body'=>$this->data['message'],'email_footer'=>$this->data['footer'],'dear'=>$this->data['dear']]);
    }
}
