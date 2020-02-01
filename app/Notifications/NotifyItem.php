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
    private $item;
    private $descriptionValidation;

    /**
     * Create a new notification instance.
     *
     * @param $item
     * @param $descriptionValidation
     */
    public function __construct($item , $descriptionValidation)
    {
        $this->item=$item;
        $this->descriptionValidation=$descriptionValidation;
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
        return (new MailMessage)
                    ->subject('message to founder Item')
            ->markdown('mail.notifyitem', [
            'item'=>$this->item,
                'descriptionValidation'=>$this->descriptionValidation
            ]);
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
