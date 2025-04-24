<?php

namespace App\Services;

use App\Models\Slider;
use App\Services\Interfaces\SliderServiceInterface;

class SliderService implements SliderServiceInterface
{
    public function getAllSliders()
    {
        return Slider::all();
    }

    public function getSliderById($id)
    {
        return Slider::findOrFail($id);
    }

    public function createSlider(array $data)
    {
        return Slider::create($data);
    }

    public function updateSlider($id, array $data)
    {
        $slider = Slider::findOrFail($id);
        $slider->update($data);
        return $slider;
    }

    public function deleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return true;
    }
}
