<?php

namespace Balance\UiComponents\Controller;

interface ControllerInterface
{
    /**
     * @return string
     */
    public function execute(): string;
}