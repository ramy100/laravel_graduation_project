<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserWithdrawNotification extends Notification
{
    use Queueable;
    public $body,$state;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($body,$state)
    {
        //
        $this->body=$body;
        $this->state=$state;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
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
                    ->line('Withdraw Request '. $this->state)
                    ->line($this->body)
                    ->action('Check your balance', route('balance',$notifiable))
                    ->line('Thanks for using My Design!');
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'type'=>"withdraw_request",
            'message'=>$this->body,
            'state'=>$this->state,
            'route'=>route('balance',$notifiable)
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
         return new BroadcastMessage([
        'state' => $this->state,
        'route'=> route('balance',$notifiable)
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
