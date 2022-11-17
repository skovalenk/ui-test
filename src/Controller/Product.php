<?php

namespace Balance\UiComponents\Controller;

use Balance\UiComponents\Ui\Reader\ComponentReader;

class Product implements ControllerInterface
{
    /**
     * @var ComponentReader
     */
    private ComponentReader $reader;

    public function __construct()
    {
        $this->reader = new ComponentReader();
    }

    /**
     * @return string
     */
    public function execute(): string
    {
        return json_encode($this->reader->read('product_listing'));
    }
}
