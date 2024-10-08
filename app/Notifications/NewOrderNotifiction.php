<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotifiction extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('hi iam '.$notifiable->name )
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // public function toDatabase(object $notifiable){
    //     return [
    //         'msg' => 'mahmoud buy the t-shert the cost is 300 ',
    //         'url' =>  route('admin.orders')
    //     ];
    // }
    // public function toBroadcast(object $notifiable){
    //     return [
    //         'msg' => 'mahmoud buy the t-shert the cost is 300 ',
    //         'url' =>  route('admin.orders')
    //     ];
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'msg' => 'mahmoud buy the t-shert the cost is 300 ',
            'url' =>  route('admin.orders')
        ];
    }
}
