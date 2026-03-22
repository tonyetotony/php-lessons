<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Repository\Setting\SettingRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SettingController extends Controller
{
    private const PER_PAGE = 10;
    private Collection $parents;

    public function __construct(
        private readonly SettingRepositoryInterface $settingRepository,
    )
    {
        $this->parents = Setting::active()
            ->onlyParent()
            ->select(['id', 'name'])
            ->get();
    }

    public function index()
    {
       return view('settings.index', [
           'parentSettings' => Setting::active()->onlyParent()->paginate(self::PER_PAGE),
       ]);
    }

    public function create()
    {
        $parents = Setting::active()
            ->onlyParent()
            ->select(['id', 'name'])
            ->get();

        return view('settings.create', [
            'parents' => $parents,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:settings',
            'labels' => 'required|array',
            'values' => 'required|array',
            'keys' => 'required|array',
        ]);
        $this->settingRepository->store($request);

        return redirect()->route('settings.index')
            ->with('success', 'Настройки успешно созданы.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', [
            'setting' => $setting,
            'parents' => $this->parents,
        ]);
    }

    public function update(Request $request, Setting $setting): RedirectResponse
    {
        $this->settingRepository->update($request, $setting);

        return redirect()->route('settings.index')
            ->with('success', 'Настройки успешно обновлены.');
    }

    public function destroy(string $id)
    {
        //
    }
}