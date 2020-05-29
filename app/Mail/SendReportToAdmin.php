<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Models\User;

class SendReportToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $number;
    protected $start_date;
    protected $end_date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $number, $start_date, $end_date)
    {
        $this->user = $user;
        $this->number = $number;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('page.admin.header'))
            ->markdown('admin.pages.mailadmin')
            ->with([
                'id' => $this->user->id,
                'name' => $this->user->name,
                'number' => $this->number,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);
    }
}
