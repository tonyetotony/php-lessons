<?php

namespace App\Repository\Setting;

use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface SettingRepositoryInterface
{
    public function store(Request $request): Setting;
    public function update(Request $request, Setting $setting): Setting;
    public function destroy(Setting $setting): bool;
}