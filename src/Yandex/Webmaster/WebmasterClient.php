<?php
namespace Yandex\Webmaster;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Yandex\Common\AbstractServiceClient;
use Yandex\Common\Exception\MissedArgumentException;
use Yandex\Common\Exception\ProfileNotFoundException;
use Yandex\Common\Exception\YandexException;
use Yandex\Webmaster\Models\GetHostsResponse;
use Yandex\Webmaster\Models\GetHostStatsResponse;
use Yandex\Webmaster\Models\GetHostVerifyResponse;
use Yandex\Webmaster\Models\Host;
use Yandex\Webmaster\Models\Hosts;

/**
 * Class WebmasterClient
 *
 * @package Yandex\Webmaster
 */
class WebmasterClient extends AbstractServiceClient
{

    /**
     * @var string $serviceDomain
     */
    protected $serviceDomain = 'webmaster.yandex.ru/api/v2';

    /**
     * WebmasterClient constructor.
     *
     * @param string               $token
     * @param ClientInterface|null $client
     */
    public function __construct($token = '', ClientInterface $client = null)
    {
        $this->setAccessToken($token);
        if ($client instanceof ClientInterface) {
            $this->setClient($client);
        }
    }

    /**
     * @see https://tech.yandex.ru/webmaster/doc/dg/reference/hosts-docpage/
     *
     * @return Hosts
     */
    public function getHosts()
    {
        $resource = 'hosts';

        $response = $this->sendGetRequest($resource);
        $hostsResponse = new GetHostsResponse($response);

        return $hostsResponse->getHosts();
    }

    /**
     * @see https://tech.yandex.ru/webmaster/doc/dg/reference/hosts-stats-docpage/
     *
     * @param $id
     * @return Host
     */
    public function getHostStats($id)
    {
        $resource = 'hosts/'.$id.'/stats';

        $response = $this->sendGetRequest($resource);
        $hostStatsResponse = new GetHostStatsResponse($response);

        return $hostStatsResponse->getHost();
    }


    /**
     * @see https://tech.yandex.ru/webmaster/doc/dg/reference/hosts-verify-docpage/
     *
     * @param string|int $hostId
     * @return Host
     */
    public function getHostVerify($hostId)
    {
        $resource = 'hosts/'.$hostId.'/verify';

        $response = $this->sendGetRequest($resource);
        $hostVerifyResponse = new GetHostVerifyResponse($response);

        return $hostVerifyResponse->getHost();
    }

    /**
     * @param string $resource
     * @return string
     */
    public function getServiceUrl($resource = '')
    {
        return $this->serviceScheme.'://'.$this->serviceDomain.'/'.$resource;
    }

    /**
     * @param string                                $method
     * @param \Psr\Http\Message\UriInterface|string $uri
     * @param array                                 $options
     * @return \Psr\Http\Message\ResponseInterface
     * @throws MissedArgumentException
     * @throws ProfileNotFoundException
     * @throws YandexException
     */
    protected function sendRequest($method, $uri, array $options = [])
    {
        //todo: implement Webmaster Exceptions
        try {
            $response = $this->getClient()->request($method, $uri, $options);
        } catch (ClientException $ex) {
            // get error from response
            $decodedResponseBody = $this->getDecodedBody($ex->getResponse()->getBody());
            $code = $ex->getResponse()->getStatusCode();

            // handle a service error message
            if (is_array($decodedResponseBody)
                && isset($decodedResponseBody['error'], $decodedResponseBody['message'])
            ) {
                switch ($decodedResponseBody['error']) {
                    case 'MissedRequiredArguments':
                        throw new MissedArgumentException($decodedResponseBody['message']);
                    case 'AssistantProfileNotFound':
                        throw new ProfileNotFoundException($decodedResponseBody['message']);
                    default:
                        throw new YandexException($decodedResponseBody['message'], $code);
                }
            }

            // unknown error
            throw $ex;
        }

        return $response;
    }

    /**
     * @param string $resource
     * @return mixed|\SimpleXMLIterator
     */
    public function sendGetRequest($resource = '')
    {
        $response = $this->sendRequest(
            'GET',
            $this->getServiceUrl($resource),
            [
                'headers' => [
                    'Authorization' => 'OAuth '.$this->getAccessToken(),
                ],
            ]
        );

        $decodedResponseBody = $this->getDecodedBody($response->getBody(), self::DECODE_TYPE_XML);

        return $decodedResponseBody;
    }
}
