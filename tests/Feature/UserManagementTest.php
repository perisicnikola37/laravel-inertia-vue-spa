<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_validation()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post('/users', []);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'avatar']);
    }

    public function test_user_update_feature()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $this->put('/users/' . $user->id, [
            'name' => 'John Doe',
            'email' => 'updated@mail.com']);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'updated@mail.com']
        );
    }

    public function test_user_delete_feature()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $response = $this->delete('/users/' . $user->id);

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_user_delete_feature_with_invalid_id()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->withHeaders(['X-CSRF-TOKEN' => ''])
            ->delete('/users/999');

        $response->assertStatus(302);
    }

    public function test_all_users_are_shown_on_index_page()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $response = $this->get('/users');

        $response->assertSee($user->name);
    }

    public function test_user_creation_date_is_in_valid_format()
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $response = $this->get('/users');

        $response->assertSee($user->created_at->format('d M Y'));
    }

    public function test_a_failure()
    {
        $this->assertTrue(false);
    }
}
