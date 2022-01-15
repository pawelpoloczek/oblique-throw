<?php
declare(strict_types=1);

namespace App\Model;

final class ChartData
{
    private float $initialSpeed;
    private float $throwAngle;
    private ?float $currentTime;
    private float $maximumHeight;
    private float $maximumHeightTime;
    private float $initialSpeedHorizontal;
    private float $initialSpeedVertical;
    private float $range;
    private array $coordinates;
    private float $totalTime;
    private float $currentSpeed;
    private float $currentSpeedHorizontal;
    private float $currentSpeedVertical;

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

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = $coordinates;
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
