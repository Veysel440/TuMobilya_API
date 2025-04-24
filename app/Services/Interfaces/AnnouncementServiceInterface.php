<?php

namespace App\Services\Interfaces;

interface AnnouncementServiceInterface
{
    public function getAllAnnouncements();
    public function getAnnouncementById($id);
    public function createAnnouncement(array $data);
    public function updateAnnouncement($id, array $data);
    public function deleteAnnouncement($id);
}
