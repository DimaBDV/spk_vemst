<?php

namespace App\Jobs;

use App\Notifications\OfferCimpleteNotification;
use App\Offer;
use App\Repository\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OfferCompleteJob implements ShouldQueue
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
    protected $UserRepository;

    /**
     * Create a new job instance.
     *
     * @param Offer $offer
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
        $this->UserRepository = app(UserRepository::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->UserRepository->findUserById($this->offer->user_id);
        $user->notify( new OfferCimpleteNotification($this->offer) );
    }
}
