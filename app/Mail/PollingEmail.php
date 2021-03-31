<?php

namespace App\Mail;

use App\Models\PollingStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PollingEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pollingStudent;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PollingStudent $pollingStudent)
    {
        $this->pollingStudent = $pollingStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.polling')
        ->subject('Please complete the Polling')
        ->with([
            'pollingStudent' => $this->pollingStudent
        ]);
    }
}
