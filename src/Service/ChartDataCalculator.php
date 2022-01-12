<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ChartData;

class ChartDataCalculator
{
    private const G = 10;

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

        $maxHeightTime = $chartData->getInitialSpeedVertical() / self::G;
        $chartData->setMaximumHeightTime($maxHeightTime);

        $this->calculateCoordinates($chartData);

        if ($chartData->getCurrentTime() === null) {
            return $chartData;
        }

        //todo calculate current values

        return $chartData;
    }

    private function calculateCoordinates(ChartData $chartData): void
    {
        $coordinates = [];

        for($t = 0.0; $t <= $chartData->getTotalTime(); $t += 0.1) {
            $x = $chartData->getInitialSpeedHorizontal() * $t;
            $y = ($chartData->getInitialSpeedVertical() * $t) - ((self::G * sqrt($t))/2);
            $coordinates[] = [$x, $y];
        }

        $x = $chartData->getInitialSpeedHorizontal() * $chartData->getTotalTime();
        $y = ($chartData->getInitialSpeedVertical() * $chartData->getTotalTime()) - ((self::G / 2) * sqrt($chartData->getTotalTime()));
        $coordinates[] = [$x, $y];

        $chartData->setCoordinates($coordinates);
    }
}