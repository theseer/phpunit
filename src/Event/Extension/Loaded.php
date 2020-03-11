<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Extension;

use PharIo\Manifest;
use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;

final class Loaded implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var Manifest\Manifest
     */
    private $manifest;

    public function __construct(Telemetry\Info $telemetryInfo, Manifest\Manifest $manifest)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->manifest      = $manifest;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function manifest(): Manifest\Manifest
    {
        return $this->manifest;
    }
}
