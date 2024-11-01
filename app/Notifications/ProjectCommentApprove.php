<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectCommentApprove extends Notification
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
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
                    ->subject('RANZ - Comment Approved')
                    ->greeting('Hello ' . $this->comment->user->name . '!')
                    ->line('Komentar anda dalam artikel Project RANZ telah diapprove admin.')
                    ->action('View Article', route('pj.contents.show', [
                        'content' => $this->comment->content->project_id, 
                        'project_content_id' => $this->comment->project_content_id
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
