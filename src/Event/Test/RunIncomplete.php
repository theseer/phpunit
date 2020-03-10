<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Test;

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\Framework;

final class RunIncomplete implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var Framework\Test
     */
    private $test;

    /**
     * @var Framework\IncompleteTest
     */
    private $error;

    /**
     * @var float
     */
    private $time;

    /**
     * @var bool
     */
    private $stopOnIncomplete;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\Test $test,
        Framework\IncompleteTest $error,
        float $time,
        bool $stopOnIncomplete
    ) {
        $this->telemetryInfo    = $telemetryInfo;
        $this->test             = $test;
        $this->error            = $error;
        $this->time             = $time;
        $this->stopOnIncomplete = $stopOnIncomplete;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Framework\Test
    {
        return $this->test;
    }

    public function error(): Framework\IncompleteTest
    {
        return $this->error;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function stopOnIncomplete(): bool
    {
        return $this->stopOnIncomplete;
    }
}
