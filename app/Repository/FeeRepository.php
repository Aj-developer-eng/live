<?php

namespace App\Repository;

use App\Models\fee;
use App\Repository\Interface\FeeInterface;

class FeeRepository implements FeeInterface
{
    public function getAllFee()
    {
        return fee::all();
    }

    public function getFeeById($FeeId)
    {
        return fee::findOrFail($FeeId);
    }

    public function deleteFee($FeeId)
    {
        fee::destroy($FeeId);
    }

    public function createFee(array $FeeData)
    {
        // Get the image file and remove it from the array
        $imageFile = $FeeData['photo'];
        unset($FeeData['photo']);

        $imageName = time() . '.' . $imageFile->extension();

        // Move the uploaded image to the public/images directory
        $imageFile->move(public_path('images'), $imageName);

        // Add the image name to the $FeeData array
        $FeeData['photo'] = $imageName;

        // Create the Fee with the image name included
        return fee::create($FeeData);
    }

    public function updateFee($FeeId, array $FeeData)
    {
        return fee::whereId($FeeId)->update($FeeData);
    }

    public function getAvailableFee()
    {
        return fee::where('is_available', true);
    }
}
