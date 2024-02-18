<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageSaveRequest;
use App\Http\Requests\LinkSaveRequest;
use App\Http\Requests\LocaleSaveRequest;
use App\Http\Requests\PlaceSaveRequest;
use App\Http\Requests\SectionItemSaveRequest;
use App\Http\Requests\SectionSaveRequest;
use App\Http\Requests\SubcategorySaveRequest;
use App\Models\Portfolio\PfLanguage;
use App\Models\Portfolio\PfLink;
use App\Models\Portfolio\PfLocale;
use App\Models\Portfolio\PfPlace;
use App\Models\Portfolio\PfSection;
use App\Models\Portfolio\PfSectionItem;
use App\Models\Portfolio\PfSubcategory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SectionController extends Controller
{
    public function index(): Response
    {
        $sections = PfSection::all();
        $subcategories = PfSubcategory::all();
        $places = PfPlace::all();
        return Inertia::render('Admin/Portfolio/Sections/Index', compact('sections', 'subcategories', 'places'));
    }

    public function store(SectionSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfSection::create($validated);
        return redirect()->route('portfolio.sections');
    }

    public function subcategoryStore(SubcategorySaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfSubcategory::create($validated);
        return redirect()->route('portfolio.sections');
    }

    public function placeStore(PlaceSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfPlace::create($validated);
        return redirect()->route('portfolio.sections');
    }

    public function sectionItemStore(SectionItemSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfSectionItem::create($validated);
        return redirect()->route('portfolio.sections');
    }

    public function languageStore(LanguageSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfLanguage::create($validated);
        return redirect()->route('portfolio.sections');
    }

    public function localeStore(LocaleSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfLocale::create($validated);
        return redirect()->route('portfolio.sections');
    }

    public function linkStore(LinkSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfLink::create($validated);
        return redirect()->route('portfolio.sections');
    }
}
