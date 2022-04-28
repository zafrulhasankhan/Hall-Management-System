<?php

namespace App\Notifications;

use App\Models\complain_register;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class register_verify extends Notification
{
    use Queueable;
    private $user = "";

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(complain_register $user)
    {
        // dd($user->user_name);
        $this->user = $user;
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
            'id' => $this->user->id,
            'username' => $this->user->user_name,
            'email' => $this->user->user_mail,
            'institute_name' => $this->user->hall_name,
            'dept_name' => $this->user->dept_name,
            'student_ID' => $this->user->student_ID,
            'session' => $this->user->session,
            'roomno' => $this->user->roomno,

        ];
    }
}
