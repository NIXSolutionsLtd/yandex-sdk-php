<?php
namespace Yandex\Webmaster\Models;

use Yandex\Common\XmlResponseModel;

/**
 * Class GetHostsResponse
 *
 * @package Yandex\Webmaster\Models
 */
class GetHostsResponse extends XmlResponseModel
{
    /**
     * @var Hosts $hosts
     */
    protected $hosts = null;

    /**
     * {@inheritdoc}
     */
    protected $mappingClasses = [
        'hosts' => 'Yandex\Webmaster\Models\Hosts',
    ];

    /**
     * {@inheritdoc}
     */
    protected $propNameMap = [
        'hosts' => 'hostlist',
    ];

    /**
     * Get Hosts
     *
     * @return Hosts
     */
    public function getHosts()
    {
        return $this->hosts;
    }

    /**
     * Set Hosts
     *
     * @param Hosts $hosts
     * @return $this
     */
    public function setHosts($hosts)
    {
        $this->hosts = $hosts;

        return $this;
    }
}
