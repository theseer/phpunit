<?php declare(strict_types=1);
namespace PHPUnit\Logging\XML\Element;

class PHPUnitElement extends AbstractElement {

    public function __construct(\XMLWriter $writer, string $version, string $installationType) {
        parent::__construct($writer);

        $this->startElement('phpunit');
        $this->writeAttribute('version', $version);
        $this->writeAttribute('installationType', $installationType);
    }

    public function addExtension(string $bootstrapClass, string $installationType): PHPUnitExtensionElement {
        return new PHPUnitExtensionElement($this->writer, $bootstrapClass, $installationType);
    }
}
