<?php
namespace Yandex\Common;

/**
 * XmlResponseModel for responses of Yandex API in XML Format.
 *
 * @package Yandex\Common
 */
abstract class XmlResponseModel extends Model
{
    /**
     * {@inheritDoc}
     */
    public function __construct(\SimpleXMLIterator $data)
    {
        $propertyName = $data->getName();
        $ourPropertyName = array_search($propertyName, $this->propNameMap, true);

        if (false !== $ourPropertyName) {
            $propertyName = $ourPropertyName;
        }

        if (property_exists($this, $propertyName)) {
            if (array_key_exists($propertyName, $this->mappingClasses)) {
                $this->{$propertyName} = new $this->mappingClasses[$propertyName]($data);
            } else {
                $this->{$propertyName} = (string)$data;
            }
        }
    }
}
