<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\User;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OffersNotification extends Notification
{
    use Queueable;
    // public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
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
            'icon' => 'fa-phone',
            'message' => $this->contact->email . ' sent you An Inquiry', 
            'path'=> url('admin\inquiry'),
            // 'contact' =>$notifiable->contact,
        ];
    
    }
}
