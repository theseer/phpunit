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

final class RunSkippedWithWarning implements Event
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
    private $warning;

    public function __construct(Telemetry\Info $telemetryInfo, Framework\TestCase $testCase, \Throwable $warning)
    {
        $this->telemetryInfo   = $telemetryInfo;
        $this->testCase        = $testCase;
        $this->warning         = $warning;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function testCase(): Framework\TestCase
    {
        return $this->testCase;
    }

    public function warning(): \Throwable
    {
        return $this->warning;
    }
}
