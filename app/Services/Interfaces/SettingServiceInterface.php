<?php

namespace App\Services\Interfaces;

interface SettingServiceInterface
{
    public function getAllSettings();
    public function getSettingById($id);
    public function createSetting(array $data);
    public function updateSetting($id, array $data);
    public function deleteSetting($id);
}
