<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class EnvironmentElement extends AbstractElement {
    public function __construct(XMLWriter $writer, string $os, string $hostname, string $username) {
        parent::__construct($writer);

        $this->startElement('environment');
        $this->writeAttribute('os',$os);
        $this->writeAttribute('hostname',$hostname);
        $this->writeAttribute('username', $username);
    }

    public function startPHP(string $version): PHPElement {
        return new PHPElement($this->writer, $version);
    }

    public function startPHPUnit(string $version, string $installMethod): PHPUnitElement {
        return new PHPUnitElement($this->writer, $version, $installMethod);
    }

}
