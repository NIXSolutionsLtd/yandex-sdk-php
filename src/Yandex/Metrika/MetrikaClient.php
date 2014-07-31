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
namespace Yandex\Metrika;

use Guzzle\Service\Client;
use Guzzle\Http\Message\Response;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Yandex\Common\AbstractServiceClient;

/**
 * Class MetrikaClient
 *
 * @category Yandex
 * @package Metrika
 *
 * @author Maxim Hodyrev <maximkou@gmail.com>
 * @created 31.07.2014 10:00
 */
class MetrikaClient extends AbstractServiceClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $serviceDomain = 'api-metrika.yandex.ru';

    /**
     * @param string $token access token
     */
    public function __construct($token = '')
    {
        $this->setAccessToken($token);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-list.xml
     * @param array $where
     * @return array
     */
    public function getCounterList(array $where = array())
    {
        return $this->get('counters', $where);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/add-counter.xml
     * @param string $name
     * @param string $site
     * @param array $params
     * @return array
     */
    public function addCounter($name, $site, array $params = array())
    {
        $params = array_merge($params, array(
            'name' => $name,
            'site' => $site
        ));

        return $this->add('counters', $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter.xml
     * @param $id int
     * @param array $params
     * @return array
     */
    public function getCounter($id, array $params = array())
    {
        return $this->get("counter/$id", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/edit-counter.xml
     * @param $id int
     * @param array $params
     * @return array
     */
    public function editCounter($id, array $params = array())
    {
        return $this->edit("counter/$id", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/delete-counter.xml
     * @param $id int
     * @return array
     */
    public function deleteCounter($id)
    {
        return $this->delete("counter/$id");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-goal-list.xml
     * @param $id int
     * @return array
     */
    public function getCounterGoalList($id)
    {
        return $this->get("counter/$id/goals");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/add-counter-goal.xml
     * @param $counterId int
     * @param $params array
     * @return array
     */
    public function addCounterGoal($counterId, array $params = array())
    {
        return $this->add("counter/$counterId/goals", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-goal.xml
     * @param $counterId int
     * @param $goalId int
     * @return array
     */
    public function getCounterGoal($counterId, $goalId)
    {
        return $this->get("counter/$counterId/goal/$goalId");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/edit-counter-goal.xml
     * @param $counterId int
     * @param $goalId int
     * @param $params array
     * @return array
     */
    public function editCounterGoal($counterId, $goalId, array $params = array())
    {
        return $this->edit("counter/$counterId/goal/$goalId", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/del-counter-goal.xml
     * @param $counterId int
     * @param $goalId int
     * @return array
     */
    public function deleteCounterGoal($counterId, $goalId)
    {
        return $this->delete("counter/$counterId/goal/$goalId");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-filter-list.xml
     * @param $id int
     * @return array
     */
    public function getCounterFilterList($id)
    {
        return $this->get("counter/$id/filters");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/add-counter-filter.xml
     * @param $id int
     * @param $params array
     * @return array
     */
    public function addCounterFilter($id, array $params = array())
    {
        return $this->add("counter/$id/filters", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-filter.xml
     * @param $counterId int
     * @param $filterId int
     * @return array
     */
    public function getCounterFilter($counterId, $filterId)
    {
        return $this->get("counter/$counterId/filter/$filterId");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/edit-counter-filter.xml
     * @param $counterId int
     * @param $filterId int
     * @param $params array
     * @return array
     */
    public function editCounterFilter($counterId, $filterId, array $params = array())
    {
        return $this->edit("counter/$counterId/filter/$filterId", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/del-counter-filter.xml
     * @param $counterId int
     * @param $filterId int
     * @return array
     */
    public function deleteCounterFilter($counterId, $filterId)
    {
        return $this->delete("counter/$counterId/filter/$filterId");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-operation-list.xml
     * @param $id int
     * @return array
     */
    public function getCounterOperationList($id)
    {
        return $this->get("counter/$id/operations");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/add-counter-operation.xml
     * @param $id int
     * @param $params array
     * @return array
     */
    public function addCounterOperation($id, array $params = array())
    {
        return $this->add("counter/$id/operations", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-operation.xml
     * @param $counterId int
     * @param $operationId int
     * @return array
     */
    public function getCounterOperation($counterId, $operationId)
    {
        return $this->get("counter/$counterId/operation/$operationId");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/edit-counter-operation.xml
     * @param $counterId int
     * @param $operationId int
     * @param $params array
     * @return array
     */
    public function editCounterOperation($counterId, $operationId, array $params = array())
    {
        return $this->edit("counter/$counterId/operation/$operationId", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/del-counter-operation.xml
     * @param $counterId int
     * @param $operationId int
     * @return array
     */
    public function deleteCounterOperation($counterId, $operationId)
    {
        return $this->delete("counter/$counterId/operation/$operationId");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-grant-list.xml
     * @param $counterId int
     * @return array
     */
    public function getCounterGrantList($counterId)
    {
        return $this->get("counter/$counterId/grants");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/add-counter-grant.xml
     * @param $counterId int
     * @param $params array
     * @return array
     */
    public function addCounterGrant($counterId, array $params = array())
    {
        return $this->add("counter/$counterId/grants", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-counter-grant.xml
     * @param $counterId int
     * @param $userLogin string
     * @return array
     */
    public function getCounterGrant($counterId, $userLogin)
    {
        return $this->get("counter/$counterId/grant/$userLogin");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/edit-counter-grant.xml
     * @param $counterId int
     * @param $userLogin string
     * @param $params array
     * @return array
     */
    public function editCounterGrant($counterId, $userLogin, array $params = array())
    {
        return $this->edit("counter/$counterId/grant/$userLogin", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/del-counter-grant.xml
     * @param $counterId int
     * @param $userLogin string
     * @return array
     */
    public function deleteCounterGrant($counterId, $userLogin)
    {
        return $this->delete("counter/$counterId/grant/$userLogin");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-delegates.xml
     * @return array
     */
    public function getDelegates()
    {
        return $this->get("delegates");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/edit-delegates.xml
     * @param $params array
     * @return array
     */
    public function editDelegates(array $params = array())
    {
        return $this->edit("delegates", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/add-delegate.xml
     * @param $params array
     * @return array
     */
    public function addDelegate(array $params = array())
    {
        return $this->add("delegates", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/del-delegate.xml
     * @param $userLogin string
     * @return array
     */
    public function deleteDelegate($userLogin)
    {
        return $this->delete("delegate/$userLogin");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-accounts.xml
     * @return array
     */
    public function getAccounts()
    {
        return $this->get("accounts");
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/get-accounts.xml
     * @param $params array
     * @return array
     */
    public function editAccounts(array $params = array())
    {
        return $this->edit("accounts", $params);
    }

    /**
     * @see http://api.yandex.ru/metrika/doc/ref/reference/del-account.xml
     * @param $userLogin string
     * @return array
     */
    public function deleteAccount($userLogin)
    {
        return $this->delete("account/$userLogin");
    }

    /**
     * Отчеты статистики
     *
     * Пример использования: getStat('traffic/summary', 100)
     *
     * @param $item string отчет
     * @param $counterId int
     * @param array $params
     * @return array
     */
    public function getStat($item = null, $counterId, array $params = array())
    {
        $params['id'] = $counterId;

        return $this->get("stat/$item", $params);
    }

    /**
     * @param $resource string
     * @param $format string
     * @return Client
     */
    protected function getClient($resource = '', $format = '.json')
    {
        if (!empty($resource)) {
            $resource .= $format;
        }

        return new Client($this->getServiceUrl($resource));
    }

    protected function get($resource, array $queryParams = array())
    {
        $request = $this->getClient($resource)->createRequest(RequestInterface::GET);
        foreach ($queryParams as $name => $val) {
            $request->getQuery()->add($name, $val);
        }

        return $this->getJsonRequestResult($request);
    }

    protected function add($resource, array $params = array())
    {
        $request = $this->getClient($resource)
            ->createRequest(RequestInterface::POST, null, null, json_encode($params));

        return $this->getJsonRequestResult($request);
    }

    protected function edit($resource, array $params = array())
    {
        $request = $this->getClient($resource)
            ->createRequest(RequestInterface::PUT, null, null, json_encode($params));

        return $this->getJsonRequestResult($request);
    }

    protected function delete($resource)
    {
        return $this->getJsonRequestResult(
            $this->getClient($resource)->createRequest(RequestInterface::DELETE)
        );
    }

    protected function getJsonRequestResult(RequestInterface $request)
    {
        return $this->sendRequest($request)->json();
    }
}
