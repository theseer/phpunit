<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Bootstrap;

use PHPUnit\Event\Event;
use PHPUnit\Event\Telemetry;

final class Finished implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $resolvedFilename;

    public function __construct(Telemetry\Info $telemetryInfo, string $filename, string $resolvedFilename)
    {
        $this->telemetryInfo    = $telemetryInfo;
        $this->filename         = $filename;
        $this->resolvedFilename = $resolvedFilename;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function resolvedFilename(): string
    {
        return $this->resolvedFilename;
    }
}
