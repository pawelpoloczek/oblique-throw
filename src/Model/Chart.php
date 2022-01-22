<?php
declare(strict_types=1);

namespace App\Model;

class Chart
{
    private array $headers;
    private array $coordinates;

    public function __construct(
        array $headers,
        array $coordinates
    ) {
        if (count($headers) !== count(reset($coordinates))) {
            throw new \InvalidArgumentException(
                'The size of the header array and the coordinates must be the same.'
            );
        }

        $this->headers = $headers;
        $this->coordinates = $coordinates;
    }

    public function __toArray(): array
    {
        return \array_merge($this->headers, $this->coordinates);
    }
}