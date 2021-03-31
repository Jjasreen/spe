<?php

namespace App\Mail;

use App\Models\DisputeCaseRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DisputeCaseEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $disputecase;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DisputeCaseRequest $disputecase)
    {
        $this->disputecase = $disputecase;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.disputecase')
        ->subject('Please use this if u want to dispute case')
        ->with([
            'disputecase' => $this->disputecase
        ]);
        
        ;
    }
}
