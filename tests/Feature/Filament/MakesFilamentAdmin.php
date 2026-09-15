<?php

namespace Tests\Feature\Filament;

use App\Models\User;
use Filament\Facades\Filament;

/**
 * Authenticates a user who may access the /control panel (config('filament.admin_emails'))
 * and selects the panel so navigation/resources resolve as they do in a real request.
 */
trait MakesFilamentAdmin
{
    protected function actingAsFilamentAdmin(): User
    {
        $user = User::where('email', 'admin@example.test')->first()
            ?? User::factory()->create(['email' => 'admin@example.test', 'email_verified_at' => now()]);

        config()->set('filament.admin_emails', array_merge(config('filament.admin_emails', []), [$user->email]));

        $this->actingAs($user);
        Filament::setCurrentPanel(Filament::getPanel('control'));
        Filament::bootCurrentPanel();

        return $user;
    }
}
