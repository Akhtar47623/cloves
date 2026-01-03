<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\User;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentsNotification extends Notification
{
    use Queueable;
    // public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {

        return [
            'message' => $this->comment->email . ' Post A Comment', 
            'path'=> url('panel\admin\usercomment'),
        ];
    
    }
}
