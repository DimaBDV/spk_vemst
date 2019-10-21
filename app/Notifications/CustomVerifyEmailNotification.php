<?php

namespace App\Notifications;

//use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmailNotification extends Notification //implements ShouldQueue
{
//    TODO: перевести это уведомление на
//      use Queueable;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Данные пользователя
     * @var array
     */
    public $user;

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via( $notifiable )
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable )
    {
        $this->userData($notifiable);
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage)
            ->greeting('Здравствуйте ' . $this->user['Name'])
            ->subject(Lang::get('Подтверждение E-mail адреса'))
            ->line(Lang::get('Только что выш E-mail адрес был использован для регистрации в сервисе ' . env('APP_NAME')))
            ->line('Проверьте Ваши данные:')
            ->line('Имя Отчество - ' . $this->user['Name'])
            ->line(Lang::get('Подразделение - ' . $this->user['Unit']))
            ->line(Lang::get('E-mail указанный при регистрации - ' . $this->user['Email']))
            ->line(Lang::get('Пожалуйста нажмите на кнопку чтобы подтвердить.'))
            ->action(Lang::get('Подтвердить E-mail'), $verificationUrl)
            ->line(Lang::get('Если вы не создавали аккаунт, просто закройте данное письмо, ничего нажимать не требуется.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed $notifiable
     * @return string
     */
    protected function verificationUrl( $notifiable )
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    protected function userData( $notifiable )
    {

        $this->user['Name'] = ($notifiable->name . ' ' . $notifiable->fathers_name) ?? null;
        $this->user['Unit'] = $notifiable->unit ?? null;
        $this->user['Email'] = $notifiable->email ?? null;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure $callback
     * @return void
     */
    public static function toMailUsing( $callback )
    {
        static::$toMailCallback = $callback;
    }
}
