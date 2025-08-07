<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TableReservated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Reservation $reservation)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reservation Confirmation')
            ->greeting('Hello ' . $this->reservation->user->name . ',')
            ->line('Your reservation has been successfully created.')
            ->line('Details:')
            ->line('Table Number: ' . $this->reservation->table_number)
            ->line('Start Time: ' . $this->reservation->start_time->format('Y-m-d H:i'))
            ->line('End Time: ' . $this->reservation->end_time->format('Y-m-d H:i'))
            ->line('People Count: ' . $this->reservation->people_count)
            ->action('View Reservations', url(route('dashboard')));
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
