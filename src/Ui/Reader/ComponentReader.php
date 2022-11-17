<?php

namespace Balance\UiComponents\Ui\Reader;

class ComponentReader
{
    private const ID_ATTRIBUTE = 'name';
    private const PATH_TO_UI_COMPONENT_DIR = 'ui_component';

    /**
     * @var array
     */
    private array $definitionData;

    public function __construct()
    {
        $definitionReader = new DefinitionReader();
        $this->definitionData = $definitionReader->read();
    }

    /**
     * Conversion flow:
     * XML -> Array -> Object<Array> -> render() -> Array -> Json
     *
     * Merge strategy:
     * read every XML -> Array<Array> -> array_replace_recursive(Array<Array>)
     * read every XML -> DomDocument -> merge on the object level -> convert to Array
     *
     * @param string $fileName
     * @return array
     */
    public function read(string $fileName): array
    {
        $filePath = SRC_ROOT . DS . self::PATH_TO_UI_COMPONENT_DIR . DS . $fileName . '.xml';
        $fileContent = file_get_contents($filePath);
        $simpleXmlElement = new \SimpleXMLElement($fileContent);
        $fragments = $this->readFragment($simpleXmlElement);

        return [$simpleXmlElement->getName() => array_replace_recursive($this->definitionData[$simpleXmlElement->getName()], $fragments)];
    }

    /**
     * @param \SimpleXMLElement $simpleXMLElement
     * @return array|string
     */
    private function readFragment(\SimpleXMLElement $simpleXMLElement)
    {
        /**
         * 1. ['listing' => ['children' => [ 'toolbar' => ['children' => ['filters']]]]
         * 2. ['filter' => ['arguments' => ['data' => ['component' => '.....'] ]]]
         */
        $fragmentData = [];

        if (!$simpleXMLElement->count()) {
            return (string) $simpleXMLElement;
        }

        /** @var \SimpleXMLElement $childElement */
        foreach ($simpleXMLElement as $childElement) {
            $idAttribute = $childElement->attributes()[self::ID_ATTRIBUTE] ?? $childElement->getName();
            $rawFragment = $this->readFragment($childElement);
            $definitionData = $this->resolveDefaultDefinition($childElement);

            if (!empty($definitionData)) {
                $fragmentData['children'][(string) $idAttribute] = array_replace_recursive(
                    $definitionData,
                    $rawFragment
                );
            } else {
                $fragmentData[(string) $idAttribute] = $rawFragment;
            }
        }

        return $fragmentData;
    }

    /**
     * @param \SimpleXMLElement $simpleXMLElement
     * @return array
     * @throws \Exception
     */
    private function resolveDefaultDefinition(\SimpleXMLElement $simpleXMLElement): array
    {
        return $this->definitionData[$simpleXMLElement->getName()] ?? [];
    }
}
