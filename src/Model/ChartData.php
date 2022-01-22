<?php
declare(strict_types=1);

namespace App\Model;

final class ChartData
{
    private float $initialSpeed;
    private float $throwAngle;
    private ?float $currentTime;
    private float $maximumHeight = 0.0;
    private float $maximumHeightTime = 0.0;
    private float $climbTime = 0.0;
    private float $fallTime = 0.0;
    private float $initialSpeedHorizontal = 0.0;
    private float $initialSpeedVertical = 0.0;
    private float $range = 0.0;
    private array $charts = [];
    private float $totalTime = 0.0;
    private float $currentSpeed = 0.0;
    private float $currentSpeedHorizontal  = 0.0;
    private float $currentSpeedVertical = 0.0;

    public function __construct(
        float $initialSpeed,
        float $throwAngle,
        ?float $currentTime
    ) {
        $this->initialSpeed = $initialSpeed;
        $this->throwAngle = $throwAngle;
        $this->currentTime = $currentTime;
    }

    public function getInitialSpeed(): float
    {
        return $this->initialSpeed;
    }

    public function getThrowAngle(): float
    {
        return $this->throwAngle;
    }

    public function getCurrentTime(): ?float
    {
        return $this->currentTime;
    }

    public function getMaximumHeight(): float
    {
        return $this->maximumHeight;
    }

    public function setMaximumHeight(float $maximumHeight): void
    {
        $this->maximumHeight = $maximumHeight;
    }

    public function getClimbTime(): float
    {
        return $this->climbTime;
    }

    public function setClimbTime(float $climbTime): void
    {
        $this->climbTime = $climbTime;
    }

    public function getFallTime(): float
    {
        return $this->fallTime;
    }

    public function setFallTime(float $fallTime): void
    {
        $this->fallTime = $fallTime;
    }

    public function getMaximumHeightTime(): float
    {
        return $this->maximumHeightTime;
    }

    public function setMaximumHeightTime(float $maximumHeightTime): void
    {
        $this->maximumHeightTime = $maximumHeightTime;
    }

    public function getInitialSpeedHorizontal(): float
    {
        return $this->initialSpeedHorizontal;
    }

    public function setInitialSpeedHorizontal(float $initialSpeedHorizontal): void
    {
        $this->initialSpeedHorizontal = $initialSpeedHorizontal;
    }

    public function getInitialSpeedVertical(): float
    {
        return $this->initialSpeedVertical;
    }

    public function setInitialSpeedVertical(float $initialSpeedVertical): void
    {
        $this->initialSpeedVertical = $initialSpeedVertical;
    }

    public function getRange(): float
    {
        return $this->range;
    }

    public function setRange(float $range): void
    {
        $this->range = $range;
    }

    /**
     * @return Chart[]
     */
    public function getCharts(): array
    {
        return $this->charts;
    }

    public function addChart(Chart $chart): void
    {
        if (!in_array($chart, $this->charts)) {
            return;
        }

        $this->charts[] = $chart;
    }

    public function getTotalTime(): float
    {
        return $this->totalTime;
    }

    public function setTotalTime(float $totalTime): void
    {
        $this->totalTime = $totalTime;
    }

    public function getCurrentSpeed(): float
    {
        return $this->currentSpeed;
    }

    public function setCurrentSpeed(float $currentSpeed): void
    {
        $this->currentSpeed = $currentSpeed;
    }

    public function getCurrentSpeedHorizontal(): float
    {
        return $this->currentSpeedHorizontal;
    }

    public function setCurrentSpeedHorizontal(float $currentSpeedHorizontal): void
    {
        $this->currentSpeedHorizontal = $currentSpeedHorizontal;
    }

    public function getCurrentSpeedVertical(): float
    {
        return $this->currentSpeedVertical;
    }

    public function setCurrentSpeedVertical(float $currentSpeedVertical): void
    {
        $this->currentSpeedVertical = $currentSpeedVertical;
    }
}
