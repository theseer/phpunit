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

final class Started implements Event
{
    /**
     * @var Telemetry\Info
     */
    private $telemetryInfo;

    /**
     * @var array
     */
    private $argv;

    /**
     * @var bool
     */
    private $exit;

    public function __construct(Telemetry\Info $telemetryInfo, array $argv, bool $exit)
    {
        $this->telemetryInfo = $telemetryInfo;
        $this->argv          = $argv;
        $this->exit          = $exit;
    }

    public function telemetryInfo(): Telemetry\Info
    {
        return $this->telemetryInfo;
    }

    public function argv(): array
    {
        return $this->argv;
    }

    public function exit(): bool
    {
        return $this->exit;
    }
}
