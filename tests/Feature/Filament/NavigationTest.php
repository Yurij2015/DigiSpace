<?php

namespace Tests\Feature\Filament;

use App\Filament\Support\PanelNavigationGroup;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use MakesFilamentAdmin;
    use RefreshDatabase;

    /** @return array<string, list<string>> group label → item labels in sidebar order */
    private function sidebar(): array
    {
        $this->actingAsFilamentAdmin();

        $groups = [];
        foreach (Filament::getNavigation() as $group) {
            /** @var NavigationGroup $group */
            $groups[$group->getLabel()] = collect($group->getItems())->map(fn ($item) => $item->getLabel())->values()->all();
        }

        return $groups;
    }

    public function test_sidebar_has_exactly_three_groups_in_order(): void
    {
        $groups = $this->sidebar();
        $named = array_values(array_filter(array_keys($groups), fn ($label) => $label !== null && $label !== ''));

        self::assertSame(['Content', 'Settings', 'Portfolio'], $named);
    }

    public function test_content_group_lists_posts_first(): void
    {
        $content = $this->sidebar()['Content'];

        self::assertSame('Posts', $content[0]);
        self::assertContains('Categories', $content);
        self::assertContains('Pages', $content);
    }

    public function test_every_resource_belongs_to_one_of_the_three_groups(): void
    {
        $labels = [PanelNavigationGroup::Content->label(), PanelNavigationGroup::Settings->label(), PanelNavigationGroup::Portfolio->label()];
        $this->actingAsFilamentAdmin();

        foreach (Filament::getResources() as $resource) {
            self::assertContains($resource::getNavigationGroup(), $labels, $resource);
        }
    }

    public function test_settings_and_portfolio_start_collapsed(): void
    {
        $this->actingAsFilamentAdmin();

        foreach (Filament::getNavigation() as $group) {
            /** @var NavigationGroup $group */
            if ($group->getLabel() === 'Content') {
                self::assertFalse($group->isCollapsed());
            } elseif (in_array($group->getLabel(), ['Settings', 'Portfolio'], true)) {
                self::assertTrue($group->isCollapsed());
            }
        }
    }

    public function test_group_labels_follow_the_panel_language(): void
    {
        app()->setLocale('uk');

        self::assertSame('Контент', PanelNavigationGroup::Content->label());
        self::assertSame('Налаштування', PanelNavigationGroup::Settings->label());
    }
}
