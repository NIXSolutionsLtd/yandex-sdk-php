<?php
namespace Yandex\Webmaster\Models;

use Yandex\Common\Model;

/**
 * Class Verification
 *
 * @package Yandex\Webmaster\Models
 */
class Verification extends Model
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
     * @var string $uin
     */
    protected $uin = null;
    
    /**
     * @var string $type
     */
    protected $type = null;

    /**
     * @var string $possibleToCancel
     */
    protected $possibleToCancel = null;

    /**
     * @var string $date
     */
    protected $date = null;

    /**
     * {@inheritdoc}
     */
    protected $mappingClasses = [];

    /**
     * {@inheritdoc}
     */
    protected $propNameMap = [
        'possibleToCancel' => 'possible-to-cancel',
    ];

    /**
     * Verification constructor.
     *
     * @param \SimpleXMLIterator $data
     */
    public function __construct(\SimpleXMLIterator $data)
    {
        $this->fromXml($data);
    }

    /**
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return self
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
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
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getUin()
    {
        return $this->uin;
    }

    /**
     * @param string $uin
     * @return $this
     */
    public function setUin($uin)
    {
        $this->uin = $uin;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getPossibleToCancel()
    {
        return $this->possibleToCancel;
    }

    /**
     * @param string $possibleToCancel
     * @return $this
     */
    public function setPossibleToCancel($possibleToCancel)
    {
        $this->possibleToCancel = $possibleToCancel;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return $this
     */
    protected function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}
