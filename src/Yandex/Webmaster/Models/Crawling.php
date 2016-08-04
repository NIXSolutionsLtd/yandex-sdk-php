<?php
namespace Yandex\Webmaster\Models;

use Yandex\Common\Model;

/**
 * Class Crawling
 *
 * @package Yandex\Webmaster\Models
 */
class Crawling extends Model
{
    /**
     * @var string $state
     */
    protected $state = null;
    /**
     * @var string $details
     */
    protected $details = null;

    /**
     * {@inheritdoc}
     */
    protected $mappingClasses = [];

    /**
     * {@inheritdoc}
     */
    protected $propNameMap = [];

    /**
     * Crawling constructor.
     *
     * @param \SimpleXMLIterator $data
     */
    public function __construct(\SimpleXMLIterator $data)
    {
        $this->fromXml($data);
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string|null
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }
}
