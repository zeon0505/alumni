<?php

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can access dashboard and view kuesioner list', function () {
    $this->withoutVite();

    $admin = Admin::first() ?? Admin::create([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'password' => 'password',
    ]);

    $this->actingAs($admin, 'admin')
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Selamat Datang')
        ->assertSee('Total Alumni');

    $this->actingAs($admin, 'admin')
        ->get(route('admin.kuesioner.index'))
        ->assertOk()
        ->assertSee('Kelola Kuesioner');
});
