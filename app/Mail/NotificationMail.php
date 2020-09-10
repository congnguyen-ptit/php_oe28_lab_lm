<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Models\BorrowerRecord;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $borrower_record;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BorrowerRecord $borrower_record)
    {
        $this->borrower_record = $borrower_record;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('page.mail.success'))
            ->markdown('admin.pages.mail')
            ->with([
                'id' => $this->borrower_record->id,
                'name' => $this->borrower_record->user->name,
                'book' => $this->borrower_record->book->name,
                'start_date' => $this->borrower_record->start_date,
                'end_date' => $this->borrower_record->end_date,
            ]);
    }
}
