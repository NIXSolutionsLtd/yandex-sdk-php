<?php
/**
 * Yandex PHP Library
 *
 * @copyright NIX Solutions Ltd.
 * @link https://github.com/nixsolutions/yandex-php-library
 */

/**
 * @namespace
 */

namespace Yandex\OAuth;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Yandex\Common\AbstractServiceClient;
use Yandex\OAuth\Exception\AuthRequestException;
use Yandex\OAuth\Exception\AuthResponseException;

/**
 * Class OAuthClient implements Yandex OAuth protocol
 *
 * @category Yandex
 * @package  OAuth
 *
 * @author   Eugene Zabolotniy <realbaziak@gmail.com>
 * @created  29.08.13 12:07
 */
class OAuthClient extends AbstractServiceClient
{
    /*
     * Authentication types constants
     *
     * The "code" type means that the application will use an intermediate code to obtain an access token.
     * The "token" type will result a user is redirected back to the application with an access token in a URL
     */
    const CODE_AUTH_TYPE = 'code';
    const TOKEN_AUTH_TYPE = 'token';

    /**
     * @var string
     */
    private $clientId = '';

    /**
     * @var string
     */
    private $clientSecret = '';

    /**
     * @var string
     */
    private $refreshToken = '';

    /**
     * @var string
     */
    protected $serviceDomain = 'oauth.yandex.ru';

    /**
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct($clientId = '', $clientSecret = '')
    {
        $this->setClientId($clientId);
        $this->setClientSecret($clientSecret);
    }

    /**
     * @param string $clientId
     *
     * @return self
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }


    /**
     * @param string $refreshToken
     *
     * @return self
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $clientSecret
     *
     * @return self
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $type
     * @param string $state optional string
     *
     * @return string
     */
    public function getAuthUrl($type = self::CODE_AUTH_TYPE, $addtions = null)
    {
        $url = $this->getServiceUrl('authorize') . '?response_type=' . $type . '&client_id=' . $this->clientId;


        if (isset($addtions)) {

            if (isset($addtions['state'])) {
                $url .= '&state=' . $addtions['state'];
            }
            
             if (isset($addtions['redirect_uri'])) {
                $url .= '&redirect_uri=' . $addtions['redirect_uri'];
            }


            if (isset($addtions['force_confirm']) && ($addtions['force_confirm'] == 'yes' || $addtions['force_confirm'] == 'no')) {
                $url .= '&force_confirm=' . $addtions['force_confirm'];
            }


            if (isset($addtions['scope']) && is_array($addtions['scope'])) {
                $url .= '&scope=';

                foreach ($addtions['scope'] as $item) {
                    $url .= $item . " ";
                }
            }

        }


        return $url;
    }

    /**
     * Sends a redirect to the Yandex authentication page.
     *
     * @param bool $exit indicates whether to stop the PHP script immediately or not
     * @param string $type a type of the authentication procedure
     * @param string $state optional string
     * @return bool|void
     */
    public function authRedirect($exit = true, $type = self::CODE_AUTH_TYPE, $addtions = null)
    {
        header('Location: ' . $this->getAuthUrl($type, $addtions));

        return $exit ? exit() : true;
    }

    /**
     * Exchanges a temporary code for an access token.
     *
     * @param $code
     *
     * @return self
     * @throws AuthResponseException on a response format error
     * @throws RequestException on an unknown request error
     *
     * @throws AuthRequestException on a known request error
     */
    public function requestAccessToken($code)
    {
        $client = $this->getClient();

        try {
            $response = $client->request(
                'POST',
                '/token',
                [
                    'auth' => [
                        $this->clientId,
                        $this->clientSecret
                    ],
                    'form_params' => [
                        'grant_type' => 'authorization_code',
                        'code' => $code,
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret
                    ]
                ]
            );
        } catch (ClientException $ex) {
            $result = $this->getDecodedBody($ex->getResponse()->getBody());

            if (is_array($result) && isset($result['error'])) {
                // handle a service error message
                $message = 'Service responsed with error code "' . $result['error'] . '".';

                if (isset($result['error_description']) && $result['error_description']) {
                    $message .= ' Description "' . $result['error_description'] . '".';
                }
                throw new AuthRequestException($message, 0, $ex);
            }

            // unknown error. not parsed error
            throw $ex;
        }

        try {
            $result = $this->getDecodedBody($response->getBody());
        } catch (\RuntimeException $ex) {
            throw new AuthResponseException('Server response can\'t be parsed', 0, $ex);
        }

        if (!is_array($result)) {
            throw new AuthResponseException('Server response has unknown format');
        }

        if (!isset($result['access_token'])) {
            throw new AuthResponseException('Server response doesn\'t contain access token');
        }

        $this->setAccessToken($result['access_token']);

        dd($result);

        $lifetimeInSeconds = $result['expires_in'];

        $expireDateTime = new \DateTime();
        $expireDateTime->add(new \DateInterval('PT' . $lifetimeInSeconds . 'S'));

        $this->setExpiresIn($expireDateTime);

        return $this;
    }
}
