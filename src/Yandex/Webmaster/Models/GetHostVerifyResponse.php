<?php
namespace Yandex\Webmaster\Models;

use Yandex\Common\XmlResponseModel;

/**
 * Class GetHostStatsResponse
 *
 * @package Yandex\Webmaster\Models
 */
class GetHostVerifyResponse extends XmlResponseModel
{
    /**
     * @var Host $host
     */
    protected $host;

    /**
     * {@inheritdoc}
     */
    protected $mappingClasses = [
        'host' => 'Yandex\Webmaster\Models\Host',
    ];

    /**
     * {@inheritdoc}
     */
    protected $propNameMap = [
        'host' => 'host',
    ];

    /**
     * Get Host
     *
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set Host
     *
     * @param $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
}
