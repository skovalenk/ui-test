<?php

namespace Balance\UiComponents\Ui\Reader;

class DefinitionReader
{
    private const PATH_TO_UI_COMPONENT_DIR = 'ui_component';

    /**
     * Conversion flow:
     * XML -> Array -> Object<Array> -> render() -> Array -> Json
     *
     * Merge strategy:
     * read every XML -> Array<Array> -> array_replace_recursive(Array<Array>)
     * read every XML -> DomDocument -> merge on the object level -> convert to Array
     *
     * @return array
     */
    public function read(): array
    {
        $definitionData = [];
        $filePath = SRC_ROOT . DS . self::PATH_TO_UI_COMPONENT_DIR . DS . 'definition.xml';
        $fileContent = file_get_contents($filePath);
        $simpleXmlElement = new \SimpleXMLElement($fileContent);

        /** @var \SimpleXMLElement $child */
        foreach ($simpleXmlElement as $child) {
            $definitionData[$child->getName()] = [
                'arguments' => [
                    'data' => ((array) $child->attributes())['@attributes']
                ]
            ];
        }

        return $definitionData;
    }
}
