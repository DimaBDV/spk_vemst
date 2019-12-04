<?php

namespace App\Jobs;

use App\Notifications\OfferDeleteNotification;
use App\Notifications\OfferDeleteToAdminNotification;
use App\Offer;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OfferDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;

    /**
     * Модель offer (предложение с которым работаем)
     * @var Offer
     */
    protected $offer;

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $OfferRepository;

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $UserRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
        $this->OfferRepository = app(OfferRepository::class);
        $this->UserRepository = app(UserRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(User $user)
    {
        $user = $this->UserRepository->findUserById($this->offer->user_id);
        $user->notify( new OfferDeleteNotification($this->offer) );

        $admins = $this->UserRepository->getAllAdmins();
        $admins->each(function ($item, $key) {
            return $item->notify( new OfferDeleteToAdminNotification($this->offer) );
        });
    }
}
