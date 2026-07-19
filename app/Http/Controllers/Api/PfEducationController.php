<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio\PfEducation;
use Illuminate\Http\JsonResponse;
use JsonException;

class PfEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws JsonException
     */
    public function index(): JsonResponse
    {
        $education = PfEducation::with(
            'pfEducationItem.pfEducationItemPlace.pfEducationItemPlaceLocale',
            'pfEducationInfoLocale', 'pfEducationItem.pfEducationItemLocale'
        )->get();
        $education = $this->prepareJsonToClient($education);

        return response()->json($education);
    }

    /**
     * @throws JsonException
     */
    private function prepareJsonToClient($ecucation): array
    {
        $data = $ecucation->toArray();
        $data = reset($data);
        $eduInfoLocales = $this->getEduInfoLocales($data['pf_education_info_locale']);
        $items = $this->getEduItems($data);

        return ['locales' => $eduInfoLocales, 'items' => $items];
    }

    private function getEduInfoLocales($pf_education_info_locale): ?array
    {
        foreach ($pf_education_info_locale as $locale) {
            $eduInfoLocales[$locale['locale']] = [
                'title' => $locale['title'],
                'description' => $locale['description'],
            ];
        }

        return $eduInfoLocales ?? null;
    }

    /**
     * @throws JsonException
     */
    private function getEduItems($data): ?array
    {
        foreach ($data['pf_education_item'] as $eduPlace) {
            $eduItemLocales = [];
            foreach ($eduPlace['pf_education_item_locale'] as $locale) {
                $eduItemLocales[$locale['locale']] = [
                    'title' => $locale['title'],
                    'description' => $locale['description'],
                ];
            }

            $items[] = [
                'id' => $eduPlace['name'],
                'place' => $this->getEduItemPlace($eduPlace),
                'period' => $eduPlace['period'],
                //                'period' => json_decode($eduPlace['period'], false, 512, JSON_THROW_ON_ERROR),
                'locales' => $eduItemLocales,
            ];
        }

        return $items ?? null;
    }

    private function getEduItemPlace($eduPlace): array
    {
        $eduItemPlacelocales = [];
        $logoUrl = null;
        $faIcon = null;
        foreach ($eduPlace['pf_education_item_place'] as $place) {
            $logoUrl = $place['logoUrl'];
            $faIcon = $place['faIcon'];
            foreach ($place['pf_education_item_place_locale'] as $placeLocale) {
                $eduItemPlacelocales[$placeLocale['locale']] = $this->getEduItemPlaceLocales($placeLocale);
            }
        }

        return [
            'logoUrl' => $logoUrl,
            'faIcon' => $faIcon,
            'locales' => $eduItemPlacelocales,
        ];
    }

    private function getEduItemPlaceLocales($placeLocale): ?array
    {
        return [
            'title' => $placeLocale['title'],
            'description' => $placeLocale['description'],
        ] ?? null;
    }
}
