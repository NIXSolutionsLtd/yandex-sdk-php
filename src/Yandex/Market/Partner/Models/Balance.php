<?php

namespace Yandex\Market\Partner\Models;

use Yandex\Common\Model;

class Balance extends Model
{
    protected $balance = null;

    protected $daysLeft = null;

    protected $recommendedPayment = null;

    /**
     * Retrieve the balance property
     *
     * @return int|null
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set the balance property
     *
     * @param int $balance
     * @return $this
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * @return  int|null
     */
    public function getDaysLeft()
    {
        return $this->daysLeft;
    }

    /**
     *
     */
    public function setDaysLeft($daysLeft)
    {
        $this->daysLeft = $daysLeft;
        return $this;
    }

    /**
     * @return  int|null
     */
    public function getRecommendedPayment()
    {
        return $this->recommendedPayment;
    }

    /**
     *
     */
    public function setRecommendedPayment($recommendedPayment)
    {
        $this->recommendedPayment = $recommendedPayment;
        return $this;
    }
}
