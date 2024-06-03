<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Carbon\Carbon;

function calculateDiffMinutes(string $beforeDateStr, string $afterDateStr): int
{
    $beforeDate = new DateTime('@' . $beforeDateStr);
    $afterDate = new DateTime('@' . $afterDateStr);
    return $afterDate->diff($beforeDate)->i;
}

function calculateDiffDays(string $beforeDateStr, string $afterDateStr): int
{
    $beforeDate = new Carbon($beforeDateStr);
    // Remove time to just compare dates
    $beforeDate->setTime(0, 0, 0);
    $afterDate = new Carbon($afterDateStr);
    $afterDate->setTime(0, 0, 0);
    return $afterDate->diffInDays($beforeDate);
}

function calculateDiffDaysFromNow(string $afterDateStr): int
{
    return calculateDiffDays('', $afterDateStr);
}

function calculateAge(string $dobStr): int
{
    $dob = new Carbon($dobStr);
    // Remove time to just compare dates
    $dob->setTime(0, 0, 0);
    $now = new Carbon(date('Y-m-d', time()));
    $now->setTime(0, 0, 0);
    return $now->diffInYears($dob);
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