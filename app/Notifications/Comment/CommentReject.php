<?php

namespace App\Notifications\Comment;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReject extends Notification
{
    use Queueable;

    protected $comment, $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct($comment, $reason)
    {
        $this->comment = $comment;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('RANZ - Comment Rejected')
                    ->greeting('Hello ' . $this->comment->user->name . '!')
                    ->line('Komentar anda dalam article RANZ direject oleh admin.')
                    ->line('Alasan: ' . $this->reason)
                    ->action('View Article', route('tutorials.title.show', [
                        'title' => $this->comment->tutorial->title_id, 
                        'tutorial_id' => $this->comment->tutorial_id
                    ]))
                    ->line('Terimakasih atas kontribusi anda.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
