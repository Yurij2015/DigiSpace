<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\PfEducation;
use App\Models\PfEducationItem;
use App\Models\PfEducationItemLocale;
use App\Models\PfEducationItemPlace;
use App\Models\PfEducationItemPlaceLocale;
use DB;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use JsonException;
use Log;

class EducationController extends Controller
{
    public function index(): Response
    {
        $education = PfEducation::with(
            'pfEducationItem.pfEducationItemPlace.pfEducationItemPlaceLocale',
            'pfEducationInfoLocale', 'pfEducationItem.pfEducationItemLocale'
        )->first();
        return Inertia::render('Admin/Portfolio/Education/Index', [
            'education' => $education
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Portfolio/Education/Create');
    }

    public function store(Request $request): ?RedirectResponse
    {

        $education = PfEducation::first();
        $educationId = $education->id;

        try {
            DB::beginTransaction();
            Log::info('transaction begin');

            $pfEducationItem = PfEducationItem::create([
                'education_id' => $educationId,
                'name' => $request->get('itemName'),
                'period' => [$request->get('itemPeriod')],
            ]);

            Log::info('$pfEducationItem ' . $pfEducationItem->id);

            PfEducationItemLocale::create([
                'education_item_id' => $pfEducationItem->id,
                'locale' => 'en',
                'title' => $request->get('itemLocaleEnName'),
                'description' => $request->get('itemLocaleEnDescription')
            ]);

            Log::info('PfEducationItemLocale en');


            PfEducationItemLocale::create([
                'education_item_id' => $pfEducationItem->id,
                'locale' => 'ua',
                'title' => $request->get('itemLocaleUaName'),
                'description' => $request->get('itemLocaleUaDescription')
            ]);

            Log::info('PfEducationItemLocale ua');


            PfEducationItemLocale::create([
                'education_item_id' => $pfEducationItem->id,
                'locale' => 'pl',
                'title' => $request->get('itemLocalePlName'),
                'description' => $request->get('itemLocalePlDescription')
            ]);

            Log::info('PfEducationItemLocale pl');


            $pfEducationItemPlace = PfEducationItemPlace::create([
                'education_item_id' => $pfEducationItem->id,
                'logoUrl' => $request->get('placeLogoUrl'),
                'faIcon' => $request->get('placeFaIcon'),
            ]);

            Log::info('$pfEducationItemPlace ' . $pfEducationItemPlace);


            PfEducationItemPlaceLocale::create([
                'education_item_place_id' => $pfEducationItemPlace->id,
                'locale' => 'en',
                'title' => $request->get('itemPlaceLocaleEnName'),
                'description' => $request->get('itemPlaceLocaleEnDescription')
            ]);

            Log::info('PfEducationItemPlaceLocale en');


            PfEducationItemPlaceLocale::create([
                'education_item_place_id' => $pfEducationItemPlace->id,
                'locale' => 'ua',
                'title' => $request->get('itemPlaceLocaleUaName'),
                'description' => $request->get('itemPlaceLocaleUaDescription')
            ]);

            Log::info('PfEducationItemPlaceLocale ua');


            PfEducationItemPlaceLocale::create([
                'education_item_place_id' => $pfEducationItemPlace->id,
                'locale' => 'pl',
                'title' => $request->get('itemPlaceLocalePlName'),
                'description' => $request->get('itemPlaceLocalePlDescription')
            ]);

            Log::info('PfEducationItemPlaceLocale pl');

            Log::info('no problem');
            DB::commit();

            return redirect(route('portfolio.education'))->with('success', 'Models created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect(route('portfolio.education'))->with('error', 'Error occurred. Transaction rolled back.');
        }
    }

    public function edit(PfEducationItem $eduItem): Response
    {
        $educationItem = PfEducationItem::with(
            'pfEducationItemPlace.pfEducationItemPlaceLocale', 'pfEducationItemLocale'
        )->find($eduItem->id);

        return Inertia::render('Admin/Portfolio/Education/Edit', ['eduItem' => $educationItem]);
    }

    /**
     * @throws JsonException
     */
    public function update(Request $request, PfEducationItem $eduItem): ?RedirectResponse
    {

        try {
            DB::beginTransaction();
            Log::info('Transaction begin');

            $pfEducationItem = PfEducationItem::findOrFail($eduItem->id);

            $pfEducationItem->update([
                'name' => $request->get('itemName'),
                'period' => $request->get('itemPeriod'),
            ]);

            Log::info('$pfEducationItem ' . $pfEducationItem->id);

            foreach (['en', 'ua', 'pl'] as $locale) {
                PfEducationItemLocale::updateOrCreate(
                    ['education_item_id' => $pfEducationItem->id, 'locale' => $locale],
                    [
                        'title' => $request->get("itemLocale" . ucfirst($locale) . "Name"),
                        'description' => $request->get("itemLocale" . ucfirst($locale) . "Description"),
                    ]
                );
                Log::info("PfEducationItemLocale $locale");
            }

            $pfEducationItemPlace = PfEducationItemPlace::updateOrCreate(
                ['education_item_id' => $pfEducationItem->id],
                [
                    'logoUrl' => $request->get('placeLogoUrl'),
                    'faIcon' => $request->get('placeFaIcon'),
                ]
            );

            Log::info('$pfEducationItemPlace ' . $pfEducationItemPlace->id);

            foreach (['en', 'ua', 'pl'] as $locale) {
                PfEducationItemPlaceLocale::updateOrCreate(
                    ['education_item_place_id' => $pfEducationItemPlace->id, 'locale' => $locale],
                    [
                        'title' => $request->get("itemPlaceLocale" . ucfirst($locale) . "Name"),
                        'description' => $request->get("itemPlaceLocale" . ucfirst($locale) . "Description"),
                    ]
                );
                Log::info("PfEducationItemPlaceLocale $locale");
            }

            Log::info('No problem');
            DB::commit();

            return redirect(route('portfolio.education'))->with('success', 'Models updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return redirect(route('portfolio.education'))->with('error', 'Error occurred. Transaction rolled back.');
        }
    }

}
