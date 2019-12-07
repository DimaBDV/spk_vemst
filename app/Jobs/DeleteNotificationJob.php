<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    /**
     * UUID в таблице notifications
     * @var $notifyId
     */
    protected $notifyId;

    /**
     * @var User
     */
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($notifyId, $user)
    {
        $this->notifyId = $notifyId;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notify = $this->user->notifications()->where('id', $this->notifyId);
        $notify->delete();
    }
}
