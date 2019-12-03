<?php

namespace App\Jobs;

use App\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewOfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    protected $user;
    protected $offer;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Offer $offer
     */
    public function __construct(User $user, Offer $offer)
    {
        $this->user = $user;
        $this->offer = $offer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
