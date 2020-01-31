<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

class NotifyItem extends Notification
{
    use Queueable;
    public $user;
    public $founder;
    public $description;
    public $founderItem;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user , User $founder , $description , $founderItem)
    {
        $this->user = $user;
        $this->founder = $founder;
        $this->description = $description;
        $this->founderItem = $founderItem;
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
        $founder = $this->user->name;
        $user = $this->founder->name;
        
        return (new MailMessage)
                    ->subject('message to founder Item')
                    ->line('hello ' . $founder . ' My Name Is ' . $user)
                    ->line('this Item ' . $this->founderItem->id)
                    ->line('hello '. $founder . ' my description is ' . $this->description)
                    ->action('Accept', url('/acceptMessage/'.$this->user->id.'/'.$this->founder->id))
                    ->line('my Regards ' . $user);
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
