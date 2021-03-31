<?php

namespace App\Mail;

use App\Models\SpeStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SurveyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $speStudent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SpeStudent $speStudent)
    {
        $this->speStudent = $speStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.survey')
        ->subject('Please complete the SPE')
        ->with([
            'speStudent' => $this->speStudent
        ]);
    }
}
