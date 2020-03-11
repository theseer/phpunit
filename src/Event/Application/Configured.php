<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Application;

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\Framework;

final class Configured implements Event
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
     * @var array
     */
    private $arguments;

    public function __construct(Telemetry\Info $telemetryInfo, Framework\Test $test, array $arguments)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->test          = $test;
        $this->arguments     = $arguments;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Framework\Test
    {
        return $this->test;
    }

    public function arguments(): array
    {
        return $this->arguments;
    }
}
