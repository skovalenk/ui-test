<?php

namespace Balance\UiComponents\Ui\Components;

interface ComponentInterface
{
    /**
     *
     */
    public function prepare(): void;

    /**
     * Returns
     * - component
     * - template
     * - additional_settings: e.g. label, e.g. name
     *
     * @return array
     */
    public function toArray(): array;
}
