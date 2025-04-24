<?php

namespace App\Services\Interfaces;

interface SliderServiceInterface
{
    public function getAllSliders();
    public function getSliderById($id);
    public function createSlider(array $data);
    public function updateSlider($id, array $data);
    public function deleteSlider($id);
}
