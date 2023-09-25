<?php

namespace App\Repository\Interface;

interface ProfileInterface
{
    public function getAllProfile();
    public function getProfileById($ProfileId);
    public function deleteProfile($ProfileId);
    public function createProfile(array $ProfileData);
    public function updateProfile($ProfileId, array $ProfileData);
    public function getAvailableProfile();

    // Add more methods as per your application needs
}
