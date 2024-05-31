<?php

function calculateDiffDays(string $beforeDateStr, string $afterDateStr): int
{
    $beforeDate = new \DateTime($beforeDateStr);
    $afterDate = new \DateTime($afterDateStr);
    return $afterDate->diff($beforeDate)->days;
}

function calculateTotalPrice(float $dailyRate, string $pickupDate, string $dropoffDate): float
{
    $pickupDateTime = \DateTime::createFromFormat('Y-m-d', $pickupDate);
    $dropoffDateTime = \DateTime::createFromFormat('Y-m-d', $dropoffDate);
    $days = $pickupDateTime->diff($dropoffDateTime)->days;

    return (float)($dailyRate * $days);
}

function convertNumToEuros(int | float $amount): string
{
    return number_format((float)($amount), 2, '.', '') . '€';
}