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

final class RunFinished implements Event
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
     * @var float
     */
    private $time;

    /**
     * @var null|array
     */
    private $coverageData;

    /**
     * @var bool
     */
    private $error;

    /**
     * @var bool
     */
    private $failure;

    /**
     * @var bool
     */
    private $incomplete;

    /**
     * @var bool
     */
    private $risky;

    /**
     * @var bool
     */
    private $skipped;

    /**
     * @var bool
     */
    private $warning;

    public function __construct(
        Telemetry\Info $telemetryInfo,
        Framework\Test  $test,
        float $time,
        ?array $coverageData,
        bool $error,
        bool $failure,
        bool $incomplete,
        bool $risky,
        bool $skipped,
        bool $warning
    ) {
        $this->telemetryInfo = $telemetryInfo;
        $this->test          = $test;
        $this->time          = $time;
        $this->coverageData  = $coverageData;
        $this->error         = $error;
        $this->failure       = $failure;
        $this->incomplete    = $incomplete;
        $this->risky         = $risky;
        $this->skipped       = $skipped;
        $this->warning       = $warning;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function test(): Framework\Test
    {
        return $this->test;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function coverageData(): ?array
    {
        return $this->coverageData;
    }

    public function error(): bool
    {
        return $this->error;
    }

    public function failure(): bool
    {
        return $this->failure;
    }

    public function incomplete(): bool
    {
        return $this->incomplete;
    }

    public function risky(): bool
    {
        return $this->risky;
    }

    public function skipped(): bool
    {
        return $this->skipped;
    }

    public function warning(): bool
    {
        return $this->warning;
    }
}
