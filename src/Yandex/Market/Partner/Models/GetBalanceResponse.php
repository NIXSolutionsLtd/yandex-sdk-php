<?php

namespace Yandex\Market\Partner\Models;

use Yandex\Common\Model;

class GetBalanceResponse extends Model
{
    protected $balance = null;

    protected $mappingClasses = [
        'balance' => 'Yandex\Market\Partner\Models\Balance'
    ];

    /**
     * @return null
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param null $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

}