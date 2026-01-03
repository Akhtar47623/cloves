<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\User;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsletterNotification extends Notification
{
    use Queueable;
    // public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
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
            'message' => $this->newsletter->newsletter_email . ' Subscribed You', 
            'path'=> url('\admin\newsletters'),
            // 'newsletter' =>$notifiable->newsletter,
        ];
    
    }
}
