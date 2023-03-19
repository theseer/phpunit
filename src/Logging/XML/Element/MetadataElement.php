<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Logging\XML\Element;

use XMLWriter;

class MetadataElement extends AbstractElement
{
    public function __construct(XMLWriter $writer)
    {
        parent::__construct($writer);

        $this->startElement('configuration');
    }
}
