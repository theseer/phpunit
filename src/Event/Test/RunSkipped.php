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

final class RunSkipped implements Event
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
     * @var Framework\SkippedTest
     */
    private $error;

    /**
     * @var float
     */
    private $time;

    /**
     * @var bool
     */
    private $stopOnSkipped;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\Test $test,
        Framework\SkippedTest $error,
        float $time,
        bool $stopOnSkipped
    ) {
        $this->telemetryInfo = $telemetryInfo;
        $this->test          = $test;
        $this->error         = $error;
        $this->time          = $time;
        $this->stopOnSkipped = $stopOnSkipped;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Framework\Test
    {
        return $this->test;
    }

    public function error(): Framework\SkippedTest
    {
        return $this->error;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function stopOnSkipped(): bool
    {
        return $this->stopOnSkipped;
    }
}
