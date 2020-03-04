<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyItem extends Mailable
{
    use Queueable, SerializesModels;

    private $item;
    private $descriptionValidation;

    /**
     * Create a new notification instance.
     *
     * @param $item
     * @param $descriptionValidation
     */
    public function __construct($item, $descriptionValidation)
    {
        $this->item = $item;
        $this->descriptionValidation = $descriptionValidation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.notifyitem', [
            'item' => $this->item,
            'descriptionValidation' => $this->descriptionValidation
        ]);;
    }
}
