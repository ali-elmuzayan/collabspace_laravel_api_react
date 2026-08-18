<?php

namespace App\Listeners;

use App\Events\ProjectCreated;

class NotifyAssignedMembers
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectCreated $event): void
    {
        // when the project is created, we need to notify the assigned memebers
        // that you have been assigned to this project, wait for your tasks.
    }
}
