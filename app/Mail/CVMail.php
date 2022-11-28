<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CVMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $cvMail = $this->view('emails.cvmail', $this->data)
            ->subject("CV - {$this->data['career']->title_en}");

        return ($this->data['file']) ? $cvMail->attachFromStorageDisk('public', '/resumes/' . $this->data['file']) : $cvMail;
    }
}
