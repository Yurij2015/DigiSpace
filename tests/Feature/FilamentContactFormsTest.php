<?php

namespace Tests\Feature;

use App\Filament\Pages\ZohoLeads;
use App\Filament\Resources\ContactForms\Pages\ListContactForms;
use App\Models\ContactForm;
use App\Models\User;
use App\Services\ZohoLeadService;
use Filament\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Mockery\MockInterface;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class FilamentContactFormsTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedPublicSite();
    }

    private function admin(): User
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        config()->set('filament.admin_emails', [$user->email]);

        return $user;
    }

    private function submission(array $overrides = []): ContactForm
    {
        return ContactForm::create([
            'first_name' => 'Yurii',
            'last_name' => 'Mokryi',
            'name' => 'Yurii Mokryi',
            'email' => 'yurii@example.com',
            'phone' => '+380441234567',
            'message' => 'Need a website.',
            'source' => ContactForm::SOURCE_CONTACT_PAGE,
        ] + $overrides);
    }

    public function test_guest_is_redirected_to_filament_login(): void
    {
        $this->get('/control/contact-forms')->assertRedirect();
        $this->get('/control/zoho-leads')->assertRedirect();
    }

    public function test_admin_sees_stored_submissions(): void
    {
        $this->submission();

        $this->actingAs($this->admin())
            ->get('/control/contact-forms')
            ->assertOk()
            ->assertSee('yurii@example.com');
    }

    public function test_admin_views_a_submission(): void
    {
        $form = $this->submission();

        $this->actingAs($this->admin())
            ->get("/control/contact-forms/{$form->id}")
            ->assertOk()
            ->assertSee('Need a website.');
    }

    public function test_admin_deletes_a_submission(): void
    {
        $form = $this->submission(['email' => 'spam@example.com']);

        Livewire::actingAs($this->admin())
            ->test(ListContactForms::class)
            ->callTableAction(DeleteAction::class, $form);

        $this->assertDatabaseMissing('contact_forms', ['id' => $form->id]);
    }

    public function test_zoho_page_renders_leads(): void
    {
        $record = new class
        {
            public function getKeyValue(string $key): ?string
            {
                return [
                    'First_Name' => 'Anna',
                    'Last_Name' => 'Honcharova',
                    'Email' => 'anna@example.com',
                    'Phone' => '+380501112233',
                    'Description' => 'From the contact form',
                ][$key] ?? null;
            }
        };

        $this->mock(ZohoLeadService::class, fn (MockInterface $mock) => $mock
            ->shouldReceive('getLeadsData')->once()->andReturn([$record]));

        Livewire::actingAs($this->admin())
            ->test(ZohoLeads::class)
            ->assertSee('anna@example.com')
            ->assertSee('From the contact form');
    }

    public function test_zoho_page_survives_an_sdk_failure(): void
    {
        $this->mock(ZohoLeadService::class, fn (MockInterface $mock) => $mock
            ->shouldReceive('getLeadsData')->once()->andThrow(new \RuntimeException('invalid_code')));

        Livewire::actingAs($this->admin())
            ->test(ZohoLeads::class)
            ->assertSee('Zoho CRM request failed')
            ->assertSee('invalid_code');
    }
}
