<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class FooterPagesController extends Controller
{
    public function privacyPolicy(): View
    {
        $slug = 'privacy-policy';
        return $this->getFooterPage($slug);
    }

    public function faq(): View
    {
        $slug = 'faq';
        return $this->getFooterPage($slug);
    }

    public function support(): View
    {
        $slug = 'support';
        return $this->getFooterPage($slug);
    }

    public function getFooterPage($slug): View
    {
        $page = Page::where('slug', $slug)->first();
        return view('footer-pages.index', ['page' => $page]);
    }
}
