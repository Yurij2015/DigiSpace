<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillLocaleSaveRequest;
use App\Http\Requests\SkillSaveRequest;
use App\Http\Requests\SkillSubcategorySaveRequest;
use App\Http\Requests\SkillTypeSaveRequest;
use App\Models\Portfolio\PfSkillLocale;
use App\Models\Portfolio\PfSkills;
use App\Models\Portfolio\PfSkillSubcategory;
use App\Models\Portfolio\PfSkillType;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SkillsController extends Controller
{
    public function index(): Response
    {
        $skillTypes = PfSkillType::all();
        $skillLocales = PfSkillLocale::all();
        $skillSubcategories = PfSkillSubcategory::with('skillType')->get();
        $skills = PfSkills::with('skillType')->get();
        return Inertia::render('Admin/Portfolio/Skills/Index', compact(
            'skillTypes',
            'skillLocales',
            'skillSubcategories',
            'skills'
        ));
    }

    public function addSkillType(): Response
    {
        return Inertia::render('Admin/Portfolio/Skills/AddSkillType');
    }

    public function addSkillSubcategory(): Response
    {
        $skillTypes = PfSkillType::all();
        return Inertia::render('Admin/Portfolio/Skills/AddSkillSubcategory', compact('skillTypes'));
    }

    public function addSkill(): Response
    {
        $skillTypes = PfSkillType::all();
        return Inertia::render('Admin/Portfolio/Skills/AddSkill', compact('skillTypes'));
    }

    public function addSkillLocale(): Response
    {
        return Inertia::render('Admin/Portfolio/Skills/AddSkillLocale');
    }

    public function skillTypeStore(SkillTypeSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfSkillType::create($validated);
        return redirect()->route('portfolio.skills');
    }

    public function skillLocaleStore(SkillLocaleSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfSkillLocale::create($validated);
        return redirect()->route('portfolio.skills');
    }

    public function skillSubcategoryStore(SkillSubcategorySaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['progress'] = $validated['skill_progress'];
        PfSkillSubcategory::create($validated);
        return redirect()->route('portfolio.skills');
    }

    public function skillStore(SkillSaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        PfSkills::create($validated);
        return redirect()->route('portfolio.skills');
    }
}
