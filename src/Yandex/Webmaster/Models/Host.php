<?php
namespace Yandex\Webmaster\Models;

use Yandex\Common\Model;

/**
 * Class Host
 *
 * @package Yandex\Webmaster\Models
 */
class Host extends Model
{
    /**
     * @var string $id
     */
    protected $id = null;
    /**
     * @var string $href
     */
    protected $href = null;
    /**
     * @var string $rel
     */
    protected $rel = null;
    /**
     * @var string $name
     */
    protected $name = null;
    /**
     * @var Verification $verification
     */
    protected $verification = null;
    /**
     * @var Crawling $crawling
     */
    protected $crawling = null;
    /**
     * @var string $virused
     */
    protected $virused = null;
    /**
     * @var string $lastAccess
     */
    protected $lastAccess = null;
    /**
     * @var string $tcy
     */
    protected $tcy = null;
    /**
     * @var string $urlCount
     */
    protected $urlCount = null;
    /**
     * @var string $indexCount
     */
    protected $indexCount = null;
    /**
     * @var string $urlErrors
     */
    protected $urlErrors = null;
    /**
     * @var string $internalLinksCount
     */
    protected $internalLinksCount = null;
    /**
     * @var string $linksCount
     */
    protected $linksCount = null;

    /**
     * {@inheritdoc}
     */
    protected $mappingClasses = [
        'verification' => 'Yandex\Webmaster\Models\Verification',
        'crawling' => 'Yandex\Webmaster\Models\Crawling',
    ];

    /**
     * {@inheritdoc}
     */
    protected $propNameMap = [
        'lastAccess' => 'last-access',
        'urlCount' => 'url-count',
        'indexCount' => 'index-count',
        'urlErrors' => 'url-errors',
        'internalLinksCount' => 'internal-links-count',
        'linksCount' => 'links-count',
    ];

    /**
     * Host constructor.
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return self
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     *
     * @param string $rel
     * @return self
     */
    public function setRel($rel)
    {
        $this->rel = $rel;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * @param Verification $verification
     * @return self
     */
    public function setVerification(Verification $verification)
    {
        $this->verification = $verification;

        return $this;
    }

    /**
     * @return Crawling|null
     */
    public function getCrawling()
    {
        return $this->crawling;
    }

    /**
     * @param Crawling $crawling
     * @return self
     */
    public function setCrawling(Crawling $crawling)
    {
        $this->crawling = $crawling;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVirused()
    {
        return $this->virused;
    }

    /**
     * @param string $virused
     * @return self
     */
    public function setVirused($virused)
    {
        $this->virused = $virused;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastAccess()
    {
        return $this->lastAccess;
    }

    /**
     * @param string|null $lastAccess
     * @return self
     */
    public function setLastAccess($lastAccess)
    {
        $this->lastAccess = $lastAccess;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTcy()
    {
        return $this->tcy;
    }

    /**
     * @param string $tcy
     * @return self
     */
    public function setTcy($tcy)
    {
        $this->tcy = $tcy;

        return $this;
    }

    /**
     * @return null
     */
    public function getUrlCount()
    {
        return $this->urlCount;
    }

    /**
     * @param string $urlCount
     * @return self
     */
    public function setUrlCount($urlCount)
    {
        $this->urlCount = $urlCount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIndexCount()
    {
        return $this->indexCount;
    }

    /**
     * @param string $indexCount
     * @return self
     */
    public function setIndexCount($indexCount)
    {
        $this->indexCount = $indexCount;

        return $this;
    }
}
