<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Icon-only link to a social network with an accessible name derived from its Font Awesome class.
 */
class SocialLink extends Component
{
    /** @var array<string, string> Font Awesome brand token → human label */
    private const NETWORKS = [
        'facebook' => 'Facebook',
        'facebook-f' => 'Facebook',
        'twitter' => 'Twitter',
        'x-twitter' => 'X (Twitter)',
        'telegram' => 'Telegram',
        'telegram-plane' => 'Telegram',
        'linkedin' => 'LinkedIn',
        'linkedin-in' => 'LinkedIn',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'github' => 'GitHub',
        'whatsapp' => 'WhatsApp',
        'viber' => 'Viber',
        'behance' => 'Behance',
        'dribbble' => 'Dribbble',
        'pinterest' => 'Pinterest',
        'tiktok' => 'TikTok',
        'skype' => 'Skype',
    ];

    public string $label;

    public function __construct(
        public string $href,
        public string $icon,
        ?string $label = null,
        public string $class = 'icon icon-gray-dark icon-style-brand fa',
    ) {
        $this->label = $label ?? self::labelFor($icon);
    }

    /**
     * "fa-facebook", "fab fa-linkedin-in", "fa fa-telegram" → "Facebook", "LinkedIn", "Telegram".
     */
    public static function labelFor(string $iconClass): string
    {
        foreach (preg_split('/\s+/', trim($iconClass)) ?: [] as $token) {
            $token = strtolower(preg_replace('/^fa-/', '', $token) ?? '');

            if (isset(self::NETWORKS[$token])) {
                return self::NETWORKS[$token];
            }
        }

        return ucfirst(trim(str_replace(['fa-', 'fab', 'fas', 'far', 'fa'], '', $iconClass)) ?: __('site.social_link'));
    }

    public function isExternal(): bool
    {
        return preg_match('~^(?:[a-z][a-z0-9+.-]*:|//)~i', $this->href) === 1;
    }

    public function render(): View
    {
        return view('components.social-link');
    }
}
