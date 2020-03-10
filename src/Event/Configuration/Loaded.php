<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Configuration;

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;
use PHPUnit\TextUI;

final class Loaded implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var TextUI\Configuration\Configuration
     */
    private $configuration;

    public function __construct(Telemetry\Info $telemetryInfo, TextUI\Configuration\Configuration $configuration)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->configuration = $configuration;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function configuration(): TextUI\Configuration\Configuration
    {
        return $this->configuration;
    }
}
