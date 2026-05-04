<?php

use App\Models\User;

test('admin login screen can be rendered', function () {
    $response = $this->get('/admin/login');

    $response->assertStatus(200);
});

test('admin can authenticate using the admin login screen', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->post('/admin/login', [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin);
    $response->assertRedirect(route('admin.dashboard', absolute: false));
});

test('non-admin cannot authenticate using the admin login screen', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->from('/admin/login')->post('/admin/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/admin/login');
    $response->assertSessionHasErrors('email');
});

test('admin can access the admin dashboard', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.dashboard', absolute: false));

    $response->assertStatus(200);
});

test('normal user cannot access the admin dashboard', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($user)->get(route('admin.dashboard', absolute: false));

    $response->assertStatus(403);
});
