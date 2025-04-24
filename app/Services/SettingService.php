<?php

namespace App\Services;

use App\Models\Setting;
use App\Services\Interfaces\SettingServiceInterface;

class SettingService implements SettingServiceInterface
{
    public function getAllSettings()
    {
        return Setting::all();
    }

    public function getSettingById($id)
    {
        return Setting::findOrFail($id);
    }

    public function createSetting(array $data)
    {
        return Setting::create($data);
    }

    public function updateSetting($id, array $data)
    {
        $setting = Setting::findOrFail($id);
        $setting->update($data);
        return $setting;
    }

    public function deleteSetting($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();
        return true;
    }
}
