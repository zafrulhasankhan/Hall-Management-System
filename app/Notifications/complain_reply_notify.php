<?php

namespace App\Notifications;

use App\Models\complain;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class complain_reply_notify extends Notification
{
    use Queueable;
    public $id = "";
    private $hall_name = "";
    private $complain = "";
    private $complain_reply = "";

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $id,$hall_name,$complain,$complain_reply)
    {
        //  dd($hall_name);
        $this->id = $id;
        $this->hall_name = $hall_name;
        $this->complain = $complain;
        $this->complain_reply = $complain_reply;
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
            'id' => $this->id,
            'hall_name' => $this->hall_name,
            'complain' => $this->complain,
            'complain_reply' => $this->complain_reply,
            'msg'=>""
         ];
    }
}
