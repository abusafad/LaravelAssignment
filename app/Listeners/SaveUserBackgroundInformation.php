<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveUserBackgroundInformation
{

    protected $userService;
    /**
     * Create the event listener.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle(UserSaved $event)
    {
        // Call the method in UserService to save user details
        $this->userService->saveUserDetails($event->user);
    }
}
