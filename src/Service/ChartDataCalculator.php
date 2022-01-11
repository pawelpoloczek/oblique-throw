<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ChartData;

class ChartDataCalculator
{
    private const G = 9.81;

    public function calculateChartData(array $formData): ChartData
    {
        $chartData = new ChartData(
            $formData['initialSpeed'],
            $formData['throwAngle'],
            $formData['time']
        );

        $sinAlpha = sin(deg2rad($chartData->getThrowAngle()));
        $cosAlpha = cos(deg2rad($chartData->getThrowAngle()));

        $chartData->setInitialSpeedHorizontal($chartData->getInitialSpeed() * $cosAlpha);
        $chartData->setInitialSpeedVertical($chartData->getInitialSpeed() * $sinAlpha);

        $totalTime = (2 * $chartData->getInitialSpeed() * $sinAlpha) / self::G;
        $chartData->setTotalTime($totalTime);

        $range = (2 * sqrt($chartData->getInitialSpeed()) * $sinAlpha * $cosAlpha) / self::G;
        $chartData->setRange($range);

        $maxHeight = sqrt($chartData->getInitialSpeedVertical()) / 2 * self::G;
        $chartData->setMaximumHeight($maxHeight);

        return $chartData;
    }
}