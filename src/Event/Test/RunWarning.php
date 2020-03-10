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

final class RunWarning implements Event
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
     * @var Framework\Warning
     */
    private $warning;

    /**
     * @var float
     */
    private $time;

    /**
     * @var bool
     */
    private $stopOnWarning;

    /**
     * @var bool
     */
    private $stopOnDefect;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\Test $test,
        Framework\Warning $warning,
        float $time,
        bool $stopOnWarning,
        bool $stopOnDefect
    ) {
        $this->telemetryInfo = $telemetryInfo;
        $this->test          = $test;
        $this->warning       = $warning;
        $this->time          = $time;
        $this->stopOnWarning = $stopOnWarning;
        $this->stopOnDefect  = $stopOnDefect;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Framework\Test
    {
        return $this->test;
    }

    public function warning(): Framework\Warning
    {
        return $this->warning;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function stopOnWarning(): bool
    {
        return $this->stopOnWarning;
    }

    public function stopOnDefect(): bool
    {
        return $this->stopOnDefect;
    }
}
