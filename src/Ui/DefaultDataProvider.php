<?php

namespace Balance\UiComponents\Ui;

class DefaultDataProvider implements DataProviderInterface
{
    /**
     * @var array
     */
    private array $meta;

    /**
     * @var string
     */
    private string $table;

    /**
     * @var string
     */
    private string $primaryField;

    /**
     * @param array $meta
     */
    public function __construct(array $meta, string $table, string $primaryField = 'id')
    {
        $this->meta = $meta;
        $this->table = $table;
        $this->primaryField = $primaryField;
    }

    /**
     * @inheritDoc
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @inheritDoc
     */
    public function getData(): array
    {
        //Fetch from database
    }
}