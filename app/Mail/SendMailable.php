<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * Create a new message instance.
     *
     * @param  array  $task
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
    $subject = $this->task->approve == 1 ? 'Task Approval Notification' : 'Request Approval Notification';
    $view = $this->task->approve == 1 ? 'Mail.approval_notification' : 'Mail.request_approval';

    return $this->subject($subject)
        ->view($view)
        ->with('task', $this->task);
    }

}
