<?php

namespace Balance\UiComponents\Ui\Components;

class DefaultComponent implements ComponentInterface
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function prepare(): void
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }
}