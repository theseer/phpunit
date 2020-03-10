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

final class RunRisky implements Event
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
     * @var Framework\RiskyTestError
     */
    private $error;

    /**
     * @var bool
     */
    private $stopOnRisky;

    /**
     * @var bool
     */
    private $stopOnDefect;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\Test $test,
        Framework\RiskyTestError $error,
        bool $stopOnRisky,
        bool $stopOnDefect
    ) {
        $this->telemetryInfo = $telemetryInfo;
        $this->test          = $test;
        $this->error         = $error;
        $this->stopOnRisky   = $stopOnRisky;
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

    public function error(): Framework\RiskyTestError
    {
        return $this->error;
    }

    public function stopOnRisky(): bool
    {
        return $this->stopOnRisky;
    }

    public function stopOnDefect(): bool
    {
        return $this->stopOnDefect;
    }
}
