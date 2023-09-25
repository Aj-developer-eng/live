<?php

namespace App\Repository\Interface;

interface FeeInterface
{
    public function getAllFee();
    public function getFeeById($FeeId);
    public function deleteFee($FeeId);
    public function createFee(array $FeeData);
    public function updateFee($FeeId, array $FeeData);
    public function getAvailableFee();

    // Add more methods as per your application needs
}
