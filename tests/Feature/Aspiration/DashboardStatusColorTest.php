<?php

use App\Models\Aspiration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('renders colored status badges on the aspiration dashboard', function () {
    $this->withoutVite();

    $admin = User::factory()->create(['role' => 'admin']);

    Aspiration::create([
        'status' => 'pending',
        'subject' => 'Pending status',
        'message' => 'Pending message',
        'tracking_code' => 'ASP-PENDING',
    ]);

    Aspiration::create([
        'status' => 'reviewed',
        'subject' => 'Reviewed status',
        'message' => 'Reviewed message',
        'tracking_code' => 'ASP-REVIEWED',
    ]);

    Aspiration::create([
        'status' => 'resolved',
        'subject' => 'Resolved status',
        'message' => 'Resolved message',
        'tracking_code' => 'ASP-RESOLVED',
    ]);

    $this->actingAs($admin)
        ->get('/dashboard/aspirations')
        ->assertOk()
        ->assertSee('bg-amber-500/10', false)
        ->assertSee('bg-sky-500/10', false)
        ->assertSee('bg-emerald-500/10', false);
});
