<?php

namespace App\Repository;

use App\Models\Profile;
use App\Repository\Interface\ProfileInterface;

class ProfileRepository implements ProfileInterface
{
    public function getAllProfile()
    {
        return Profile::all();
    }

    public function getProfileById($ProfileId)
    {
        return Profile::findOrFail($ProfileId);
    }

    public function deleteProfile($ProfileId)
    {
        Profile::destroy($ProfileId);
    }

    public function createProfile(array $profileData)
    {
        // Get the image file and remove it from the array
        $imageFile = $profileData['photo'];
        unset($profileData['photo']);

        $imageName = time() . '.' . $imageFile->extension();

        // Move the uploaded image to the public/images directory
        $imageFile->move(public_path('images'), $imageName);

        // Add the image name to the $profileData array
        $profileData['photo'] = $imageName;

        // Create the profile with the image name included
        return Profile::create($profileData);
    }

    public function updateProfile($ProfileId, array $ProfileData)
    {
        // dd($ProfileData);
        $base64Image = $ProfileData['photo']; // Replace with your base64 string
        unset($ProfileData['photo']);

        list($data, $image) = explode(";base64,", $base64Image);
// Extract the image type
        list(, $image_type) = explode("image/", $data);

// Generate a unique file name with the image type
        $fileNameToStore = uniqid() . '.' . $image_type;

        $filePath = public_path('/images/' . $fileNameToStore); // Replace with your desired path and file name

        // Extract and decode the base64 data and save it directly to the file
        file_put_contents($filePath, base64_decode(explode(',', $base64Image)[1]));
        $profileData['photo'] = $filePath;
        // echo 'Image saved as ' . $filePath;die;

        return Profile::whereId($ProfileId)->update($ProfileData);
    }

    public function getAvailableProfile()
    {
        return Profile::where('is_available', true);
    }
}
