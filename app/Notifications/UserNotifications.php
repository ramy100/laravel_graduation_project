<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class UserNotifications extends Notification implements ShouldQueue
{
    use Queueable;
    public $design,$designer;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($design,$designer)
    {
        $this->design=$design;
        $this->designer=$designer;

        $this->design=$design;
        $this->designer=$designer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    // /**
    //  * Get the mail representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return \Illuminate\Notifications\Messages\MailMessage
    //  */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {   
        
        return [
            'design_id' => $this->design->id,
            'designer_name' => $this->designer->name,

            
        ];
    }
    public function toBroadcast($notifiable)
    {  
        return new BroadcastMessage([
            'design_id' => $this->design->id,
            'designer_name' => $this->designer->name,  
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
}
