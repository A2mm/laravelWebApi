<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NotifyAdminWithAddedPosts;
use App\Services\Email\NotifyAdminMailService;

class NotifyAdminWithAddedPostsListener
{
    private NotifyAdminMailService $notifyAdminMailService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NotifyAdminMailService $notifyAdminMailService)
    {
        $this->notifyAdminMailService = $notifyAdminMailService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotifyAdminWithAddedPosts $event)
    {
        return $this->notifyAdminMailService->sendPostEmail($event);
    }
}
