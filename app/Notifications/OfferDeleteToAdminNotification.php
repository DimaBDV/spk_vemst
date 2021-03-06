<?php

namespace App\Notifications;

use App\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferDeleteToAdminNotification extends Notification
{
    use Queueable;

    protected $offer;

    /**
     * Create a new notification instance.
     *
     * @param Offer $offer
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
        return ['mail', 'database'];
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
                    ->greeting('Было уладено предложение из раздела ' . $this->offer->section)
                    ->line('Ну и заябисто  (*¯︶¯*) Меньше работы больше кислорода')
                    ->action('Перейти к панели администратора', url(route('admin.index')))
//                TODO: Прихерачить кнопку просмотра архива
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
            'offer_id' => $this->offer->id,
            'section' => $this->offer->section,
            'theme' => $this->offer->theme,
        ];
    }
}
