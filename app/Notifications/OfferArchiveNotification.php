<?php

namespace App\Notifications;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferArchiveNotification extends Notification
{
    use Queueable;

    protected $offer;

    /**
     * Сообщение для пользователя
     * @var string
     */
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @param Offer $offer
     */
    public function __construct(Offer $offer, $message)
    {
        $this->offer = $offer;
        $this->message = $message;
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
            ->subject('Предложение удалено.')
            ->greeting('Здравствуйте ' . $notifiable->name . ' ' . $notifiable->fathers_name)
            ->line('Ваше предложение в раздел ' . $this->offer->section . ' было удалено и перемещено в архив.')
            ->line('Причина: ' . $this->message)
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
            //TODO: сделать уведомление в DB
        ];
    }
}
