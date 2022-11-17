<?php

namespace Balance\UiComponents\Ui;

interface DataProviderInterface
{
    /**
     * @return array
     */
    public function getMeta(): array;

    /**
     * @return array
     */
    public function getData(): array;
}