<?php

namespace App\Notifications;

use App\Models\complain;
use App\Models\complain_register;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class complain_send_notify extends Notification
{ 
    use Queueable;
    private $user = "";
    private $data = "";
   

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(complain $user, complain_register $data)
    {
     
        $this->user = $user;
        $this->data = $data;
        
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
            'id' => $this->user->user_id,
            'hall_name' => $this->user->hall_name,
            'user_name' => $this->user->user_name,
            'complain' => $this->user->complain,
            'email' => "",
            'dept_name' => $this->data->dept_name,
            'student_ID' => $this->data->student_ID,
            'session' => $this->data->session,
            'roomno' => $this->data->roomno,

        ];
    }
}
