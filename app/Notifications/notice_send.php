<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notice_send extends Notification
{
    use Queueable;
    
    private $notice_info = "";
    private $user_info = "";
    private $user_id = "";

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $notice_info,$user_info,$user_id)
    {
        //  dd($hall_name);
        $this->notice_info = $notice_info;
        $this->user_info = $user_info;
        $this->user_id = $user_id;
        
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
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
    public function toArray($notifiable)
    {
        return [
            'id' => $this->user_id,
            'hall_name' => $this->notice_info->hall_name,
            'complain' => "",
            'complain_reply' => "",
            'msg'=>$this->notice_info->notice_details
         ];
    }
}
