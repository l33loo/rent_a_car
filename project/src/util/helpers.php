<?php

function calculateDiffDays(string $beforeDateStr, string $afterDateStr): int
{
    $beforeDate = new \DateTime($beforeDateStr);
    $afterDate = new \DateTime($afterDateStr);
    return $afterDate->diff($beforeDate)->days;
}

function calculateTotalPrice(float $dailyRate, string $pickupDate, string $dropoffDate): float
{
    $days = calculateDiffDays($pickupDate, $dropoffDate);

    return (float)($dailyRate * $days);
}

function convertNumToEuros(int | float $amount): string
{
    return number_format((float)($amount), 2, '.', '') . '€';
}