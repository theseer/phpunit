<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Event\Telemetric;

final class Snapshot
{
    /**
     * @var \DateTimeImmutable
     */
    private $time;

    /**
     * @var MemoryUsage
     */
    private $memoryUsage;

    /**
     * @var MemoryUsage
     */
    private $peakMemoryUsage;

    public function __construct(\DateTimeImmutable $time, MemoryUsage $memoryUsage, MemoryUsage $peakMemoryUsage)
    {
        $this->time            = $time;
        $this->memoryUsage     = $memoryUsage;
        $this->peakMemoryUsage = $peakMemoryUsage;
    }

    public function time(): \DateTimeImmutable
    {
        return $this->time;
    }

    public function memoryUsage(): MemoryUsage
    {
        return $this->memoryUsage;
    }

    public function peakMemoryUsage(): MemoryUsage
    {
        return $this->peakMemoryUsage;
    }
}
