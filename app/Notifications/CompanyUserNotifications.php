<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CompanyUserNotifications extends Notification implements ShouldQueue
{
    use Queueable;
    public $design,$company,$link ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($design,$company,$url)
    {
        $this->design=$design;
        $this->company=$company;
        $this->link = $url;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {   
        
        return [
            'design' => $this->design,
            'company' => $this->company,  
            'product_link'=>$this->link,         
        ];
    }
    public function toBroadcast($notifiable)
    {  
        return new BroadcastMessage([
            'design' => $this->design,
            'company' => $this->company, 
            'product_link'=>$this->link,         
 
            ]);
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
