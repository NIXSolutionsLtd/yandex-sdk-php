<?php
namespace Yandex\Webmaster\Models;

use Yandex\Common\ObjectModel;

/**
 * Class Hosts
 *
 * @package Yandex\Webmaster\Models
 */
class Hosts extends ObjectModel
{
    /**
     * @var array $collection a collection of Host objects
     */
    protected $collection = [];

    /**
     * @var array $mappingClasses
     */
    protected $mappingClasses = [];

    /**
     * @var array $propNameMap
     */
    protected $propNameMap = [];

    /**
     * Hosts constructor.
     *
     * @param \SimpleXMLIterator $data
     */
    public function __construct(\SimpleXMLIterator $data)
    {
        for ($data->rewind(); $data->valid(); $data->next()) {
            $this->add($data->current());
        }

        return $this;
    }

    /**
     * Add item
     *
     * @param \SimpleXMLIterator $hostXmlNode
     * @return $this
     */
    public function add(\SimpleXMLIterator $hostXmlNode)
    {
        $host = new Host($hostXmlNode);

        $hostPathArray = explode('/', parse_url($host->getHref(), PHP_URL_PATH));
        $hostId = array_pop($hostPathArray);

        $host->setId($hostId);

        $this->collection[] = $host;

        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getAll()
    {
        return $this->collection;
    }
}
