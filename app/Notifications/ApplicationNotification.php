<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\User;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationNotification extends Notification
{
    use Queueable;
    // public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($application)
    {
        $this->application = $application;
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
            'message' => $this->application->email . ' Send An Application', 
            'path'=> url('admin\job-application'),
            // 'newsletter' =>$notifiable->newsletter,
        ];
    
    }
}
