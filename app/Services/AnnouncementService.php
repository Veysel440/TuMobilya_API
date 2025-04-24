<?php

namespace App\Services;

use App\Models\Announcement;
use App\Services\Interfaces\AnnouncementServiceInterface;

class AnnouncementService implements AnnouncementServiceInterface
{
    public function getAllAnnouncements()
    {
        return Announcement::all();
    }

    public function getAnnouncementById($id)
    {
        return Announcement::findOrFail($id);
    }

    public function createAnnouncement(array $data)
    {
        return Announcement::create($data);
    }

    public function updateAnnouncement($id, array $data)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->update($data);
        return $announcement;
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
        return true;
    }
}
