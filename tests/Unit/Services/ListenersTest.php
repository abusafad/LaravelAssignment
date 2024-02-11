<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;

class ListenersTest  extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;
    use WithoutMiddleware;
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_save_user_details_is_called_when_user_saved_event_is_dispatched()
    {
        // Mock the UserService
        $userService = $this->createMock(UserService::class);
        $userService->expects($this->once())
                    ->method('saveUserDetails')
                    ->willReturn(true);

        // Create a new user
        $user = User::factory()->create();

        // Dispatch the UserSaved event
        Event::dispatch(new UserSaved($user));

        // Verify that saveUserDetails method was called in the listener
        $listener = new SaveUserBackgroundInformation($userService);
        $listener->handle(new UserSaved($user));
    }


}
