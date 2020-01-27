<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Action;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSmsMailToFounder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $report;
    public $otherUser;
    public function __construct($report,$otherUser)
    {
        $this->report=$report;
        $this->otherUser=$otherUser;
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
//
        return (new MailMessage)
            ->line('hello'.$this->report->user->name)
            ->line('you are lately make a report
            for a lost person on our website and there is someone who
             searching for the same person and his information is:')->line(
                 'Name : '.$this->otherUser->name
                 .'Email : '.$this->otherUser->email
                 .'Phone Number : '.$this->otherUser->phone
            )->line('please approve or disapprove after meeting')
//            ->line(new Action('View Report', url('/people/reports/'.$this->report->id)))
            ->line(new Action('Close Report', url('api/closereport/'.$this->report->id)))
//            ->line(new Action('Still Report', url('/')))
            ;
//
//            return (new MailMessage)
//                ->markdown('mail.mailto',['report'=>$this->report,'otherUser'=>$this->otherUser]);
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
