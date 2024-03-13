<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\PlaceSaveRequest;
use App\Http\Requests\Section\SectionItemSaveRequest;
use App\Http\Requests\Section\SectionSaveRequest;
use App\Http\Requests\Section\SubcategorySaveRequest;
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
        $sectionItems = PfSectionItem::with(
            'section',
            'subcategory',
            'place',
            'locales.en',
            'locales.ua',
            'locales.pl',
            'links')
            ->get();

        return Inertia::render(
            'Admin/Portfolio/Sections/Index',
            compact(
                'sections',
                'subcategories',
                'places',
                'sectionItems'
            )
        );
    }

    public function store(SectionSaveRequest $sectionRequest): RedirectResponse
    {
        $validatedSection = $sectionRequest->validated();
        $section = PfSection::create($validatedSection);

        $this->addLangAndLocale($section, $sectionRequest->get('locales'), 'section_id');

        return redirect()->route('portfolio.sections');
    }

    public function subcategoryStore(SubcategorySaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $subcategory = PfSubcategory::create($validated);

        $this->addLangAndLocale($subcategory, $request->get('locales'), 'subcategory_id');

        return redirect()->route('portfolio.sections');
    }

    public function placeStore(PlaceSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $place = PfPlace::create($validated);

        $this->addLangAndLocale($place, $request->get('locales'), 'place_id');

        return redirect()->route('portfolio.sections');
    }

    public function sectionItemStore(SectionItemSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $item = PfSectionItem::create($validated);

        $this->addLangAndLocale($item, $request->get('locales'), 'item_id');
        $this->addLinks($request->get('links'), $item);

        return redirect()->route('portfolio.sections');
    }

    private function addLinks($links, $item): void
    {
        foreach ($links as $link) {
            PfLink::create([
                'item_id' => $item->id,
                'fa_icon' => $link['fa_icon'],
                'href' => $link['href']
            ]);
        }
    }

    private function addLangAndLocale($type, $locales, $typeKey): void
    {
        $enId = null;
        $uaId = null;
        $plId = null;

        foreach ($locales as $key => $locale) {
            $language = PfLanguage::create([
                'lang_code' => $key,
                'title' => $locale['title'],
                'description' => $locale['description']
            ]);
            $lang_id = $key . 'Id';
            $$lang_id = $language->id;
        }

        PfLocale::create([
            $typeKey => $type->id,
            'en_id' => $enId,
            'ua_id' => $uaId,
            'pl_id' => $plId
        ]);
    }
}
