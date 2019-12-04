<?php

namespace App\Notifications;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class OfferDeleteNotification extends Notification
{
    use Queueable;

    protected $offer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Удаление предложения.')
                    ->greeting('Здравствуйте ' . $notifiable->name . ' ' . $notifiable->fathers_name)
                    ->line('Ваше предложение в раздел ' . $this->offer->section . ' было удалено.')
                    ->line('Чтобы отменить удаление и вернуть предложение в работу нажмите кнопку ниже')
                    ->action('Отменить удаление', url( URL::signedRoute('offer.restore', ['id' => $this->offer->id]) ) )
                    ->line('Спасибо за использование нашего сервиса!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            ''
        ];
    }
}
