<?php

namespace App\Mail;

use App\Http\Controllers\StudentSecretary;
use App\Models\DeliverableStudent;
use App\Models\PollingStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecretaryEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $secSubmission;
    /**
     * Create a new message instance.
     *
     * @return void
     */            
    public function __construct(DeliverableStudent $secSubmission)
    {
        $this->secSubmission= $secSubmission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.submission')
        ->subject('Please complete the Submission')
        ->with([
            'secSubmission' => $this->secSubmission
        ]);
    }
}
