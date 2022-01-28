<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\ChartData;

class ChartDataCalculator
{
    public const G = 9.81;

    public function calculateChartData(array $formData): ChartData
    {
        $chartData = new ChartData(
            $formData['initialSpeed'],
            $formData['throwAngle']
            //$formData['time']
        );

        $sinAlpha = sin(deg2rad($chartData->getThrowAngle()));
        $cosAlpha = cos(deg2rad($chartData->getThrowAngle()));

        $chartData->setInitialSpeedHorizontal($chartData->getInitialSpeed() * $cosAlpha);
        $chartData->setInitialSpeedVertical($chartData->getInitialSpeed() * $sinAlpha);

        $totalTime = (2 * $chartData->getInitialSpeed() * $sinAlpha) / self::G;
        $chartData->setTotalTime($totalTime);

        $range = (2 * ($chartData->getInitialSpeed() ** 2) * $sinAlpha * $cosAlpha) / self::G;
        $chartData->setRange($range);
        $maxHeight = (($chartData->getInitialSpeed() ** 2) / 2 * self::G) * ($sinAlpha ** 2) / 100;
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
        $coordinates = [['Zasięg', 'Wysokość']];
        for($t = 0.00; $t <= $chartData->getTotalTime(); $t += 0.05) {
            $coordinates[] = [
                $chartData->getInitialSpeedHorizontal() * $t,
                ($chartData->getInitialSpeedVertical() * $t) - ((self::G * $t ** 2)/2)
            ];
        }

        $coordinates[] = [
            $chartData->getInitialSpeedHorizontal() * $chartData->getTotalTime(),
            ($chartData->getInitialSpeedVertical() * $chartData->getTotalTime()) - ((self::G * $chartData->getTotalTime() ** 2)/2)
        ];

        $chartData->setCoordinates($coordinates);
    }
}