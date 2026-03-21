<?php

namespace App\Repository\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SettingRepository implements SettingRepositoryInterface
{

    public function store(Request $request): Setting
    {
        $user = auth()->user();

        $newSetting = new Setting();
        $newSetting->name = $request->name;
        $newSetting->is_active = (bool)$request->is_active;
        $newSetting->save();

        foreach ($this->parseSettingsData($request) as $value) {
            $newSetting->users()->attach($user->id, $value);
        }

        return $newSetting;
    }

    public function update(Request $request, Setting $setting): Setting
    {
        $setting->name = $request->name;
        $setting->parent_id = $request->parent_id;
        $setting->is_active = (bool)$request->is_active;
        $setting->settings = $this->parseSettingsData($request);
        $setting->save();

        return $setting;
    }

    public function destroy(Setting $setting): bool
    {
    }

    private function parseSettingsData(Request $request): array
    {
        $values = array_values($request->values);
        $labels = array_values($request->labels);
        $keys = array_values($request->keys);

        $labelCount = count($labels);
        if (
            !(
                $labelCount == count($keys) &&
                $labelCount == count($values)
            )
        ) {
            throw new BadRequestHttpException();
        }

        $settingsData = [];
        for ($i = 0; $i < count($labels); $i++) {
            $settingsData[$i]['name'] = $keys[$i];
            $settingsData[$i]['value'] = $values[$i];
            $settingsData[$i]['label'] = $labels[$i];
        }

        return $settingsData;
    }
}