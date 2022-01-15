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

        //$range = (2 * sqrt($chartData->getInitialSpeed()) * $sinAlpha * $cosAlpha) / self::G;
        $range = $chartData->getInitialSpeedHorizontal() * $chartData->getTotalTime();
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
        $coordinatesX = [];
        for($t = 0.0; $t <= $chartData->getTotalTime(); $t += 0.1) {
            $coordinatesX[(string)$t] = $chartData->getInitialSpeedHorizontal() * $t;
        }

        $coordinatesY = [];
        $mht = $chartData->getMaximumHeightTime();
        for($t = 0.0; $t <= $mht; $t += 0.1) {
            $coordinatesY[(string)$t] = ($chartData->getInitialSpeedVertical() * $t) - ((self::G * sqrt($t))/2);
        }
        $coordinatesY[(string)$mht] = ($chartData->getInitialSpeedVertical() * $mht) - ((self::G * sqrt($mht))/2);
        $coordinatesYPart2 = \array_reverse($coordinatesY, true);
        unset($coordinatesYPart2[(string)$mht]);
        $arrayLastKey = \array_key_last($coordinatesY);
        foreach ($coordinatesYPart2 as $coordinate) {
            $arrayLastKey += 0.1;
            $coordinatesY[(string)$arrayLastKey] = $coordinate;
        }

        $coordinates = [];
        foreach ($coordinatesX as $key => $coordinate) {
            $coordinates[] = [$coordinate, $coordinatesY[$key]];
        }

        $chartData->setCoordinates($coordinates);
    }
}