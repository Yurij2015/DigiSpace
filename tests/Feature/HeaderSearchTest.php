<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Concerns\SeedsPublicSite;
use Tests\TestCase;

class HeaderSearchTest extends TestCase
{
    use RefreshDatabase;
    use SeedsPublicSite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedPublicSite();
    }

    public function test_header_search_form_targets_the_localized_service_search(): void
    {
        $this->get('/uk')
            ->assertOk()
            ->assertSee('action="http://localhost:8100/uk/service-search" method="GET" role="search"', false)
            ->assertSee('name="search"', false)
            ->assertDontSee('search-results.html')
            ->assertDontSee('data-search-live');
    }

    public function test_service_search_lists_matching_categorised_services(): void
    {
        $category = ServiceCategory::create(['name' => 'Web', 'slug' => 'web']);
        Service::create(['title' => 'Laravel development', 'slug' => 'laravel-development', 'service_category_id' => $category->id, 'description' => 'Backend']);
        Service::create(['title' => 'Orphaned laravel service', 'slug' => 'orphan', 'service_category_id' => null, 'description' => 'no category']);

        $this->get('/uk/service-search?search=laravel')
            ->assertOk()
            ->assertSee('Laravel development')
            ->assertDontSee('Orphaned laravel service');
    }
}
