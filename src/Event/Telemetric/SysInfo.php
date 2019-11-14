<?php declare(strict_types = 1);
namespace PHPUnit\Event\Telemetric;

class SysInfo {

    /** @var Clock */
    private $clock;

    /** @var MemInfo */
    private $memInfo;

    public function __construct(Clock $clock, MemInfo $memInfo) {
        $this->clock = $clock;
        $this->memInfo = $memInfo;
    }

    public function snapshot(): Snapshot {

        return new SnapShot(
            $this->clock->now(),
            $this->memInfo->usage(),
            $this->memInfo->peak()
        );
    }
}
