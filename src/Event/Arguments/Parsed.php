<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Arguments;

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\TextUI\Arguments\Arguments;

final class Parsed implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var Arguments
     */
    private $arguments;

    public function __construct(Telemetry\Info $telemetryInfo, Arguments $arguments)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->arguments     = $arguments;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function arguments(): Arguments
    {
        return $this->arguments;
    }
}
