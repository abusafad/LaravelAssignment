<?php

namespace Tests\Unit\Services;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */

        use RefreshDatabase;
        use WithoutMiddleware;

     protected $userService;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function test_it_can_return_a_paginated_list_of_users()
    {
         // Create some test users
         User::factory()->count(10)->create();

         // Getting the first page with 5 users per page
         $perPage = 5;
         $page = 1;
 
         // Call the list method
         $paginatedUsers = $this->userService->list($perPage, $page);
 
         // Assert that the returned value is an instance of LengthAwarePaginator
         $this->assertInstanceOf(LengthAwarePaginator::class, $paginatedUsers);
 
         // You can also perform further assertions on the returned paginator if needed
         $this->assertEquals($perPage, $paginatedUsers->perPage());
         $this->assertEquals(10, $paginatedUsers->total());
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_store_a_user_to_database()
    {
        $userData = [
            'prefixname' => "Mr",
            'firstname' => "firstname",
            'lastname' => "Moe",
            'middlename' => "Moe",
            'suffixname' => "test",
            'username'   => "testCase",
            'email'      => "testCase@testCase.com",
            'password'   => 'password',
            'password_confirmation' => 'password'
        ];

        $user = $this->userService->store($userData);

        $this->assertNotNull($user);
        $this->assertEquals($userData['username'], $user->username);
        $this->assertEquals($userData['email'], $user->email);
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_find_and_return_an_existing_user()
    {

        $user = User::factory()->create();

        $foundUser = $this->userService->find($user->id);

        $this->assertEquals($user->name, $foundUser->name);
        $this->assertEquals($user->email, $foundUser->email);
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_update_an_existing_user()
    {
        $user = User::factory()->create();

        $newName = 'Updated';

        $updatedUser = $this->userService->update($user->id, ['firstname' => $newName]);

        $this->assertEquals($newName, $updatedUser->firstname);
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_soft_delete_an_existing_user()
    {
        // Create a test user
        $user = User::factory()->create();

        // Soft delete the user
        $this->userService->delete($user->id);

        // Check if the user is soft deleted
        $this->assertSoftDeleted('users', [
            'id' => $user->id
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_return_a_paginated_list_of_trashed_users()
    {
        // Soft delete some test users
        User::factory()->count(10)->create()->each(function ($user) {
            $user->delete();
        });

        // Getting the first page with 5 trashed users per page
        $perPage = 5;
        $page = 1;

        $trashedUsers = $this->userService->listTrashed($perPage, $page);

        $this->assertInstanceOf(LengthAwarePaginator::class, $trashedUsers);

        // You can also perform further assertions on the returned paginator if needed
        $this->assertEquals($perPage, $trashedUsers->perPage());
        $this->assertEquals(10, $trashedUsers->total());
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_restore_a_soft_deleted_user()
    {
        // Create and soft delete a test user
        $user = User::factory()->create();
        $user->delete();

        // Restore the soft deleted user
        $this->userService->restore($user);

        // Check if the user is restored
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function test_it_can_permanently_delete_a_soft_deleted_user()
    {
        // Create and soft delete a test user
        $user = User::factory()->create();

        // Permanently delete the soft deleted user
        $this->userService->destroy($user->id);

        // Check if the user is permanently deleted
        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }


}
