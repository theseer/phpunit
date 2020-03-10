<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\TestCase;

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\Framework;

final class RunSkippedWithError implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var Framework\TestCase
     */
    private $testCase;

    /**
     * @var \Throwable
     */
    private $error;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\TestCase $testCase,
        \Throwable $error
    ) {
        $this->telemetryInfo = $telemetryInfo;
        $this->testCase      = $testCase;
        $this->error         = $error;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function testCase(): Framework\TestCase
    {
        return $this->testCase;
    }

    public function error(): \Throwable
    {
        return $this->error;
    }
}
