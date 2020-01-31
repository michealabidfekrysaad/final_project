<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use App\Report;

class NotifyReport extends Notification
{
    use Queueable;
    public $user;
    public $founder;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user , User $founder)
    {
       $this->user = $user;
       $this->founder = $founder;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->user->name;
        $founder = $this->founder->name;
        
        return (new MailMessage)
                    ->subject('from Loster '. $user)
                    ->line('hello '. $founder)
                    ->action('close Rport', url('/'))
                    ->action('Accept Report' , url('/'))
                    ->action('Reject Report' , url('/'))
                    ->line('Regards Laravel Fahmy');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
