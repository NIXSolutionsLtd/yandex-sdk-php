<?php

namespace Yandex\Market\Partner\Models;

use Yandex\Common\Model;

class Stat extends Model
{
    protected $date = null;

    protected $placeGroup = null;

    protected $clicks = null;

    protected $spending = null;

    protected $shows = null;
    
    protected $detailedStats = null;

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return null
     */
    public function getPlaceGroup()
    {
        return $this->placeGroup;
    }

    /**
     * @param null $placeGroup
     */
    public function setPlaceGroup($placeGroup)
    {
        $this->placeGroup = $placeGroup;
        return $this;
    }

    /**
     * @return null
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * @param null $clicks
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;
        return $this;
    }

    /**
     * @return null
     */
    public function getSpending()
    {
        return $this->spending;
    }

    /**
     * @param null $spending
     */
    public function setSpending($spending)
    {
        $this->spending = $spending;
        return $this;
    }

    /**
     * @return null
     */
    public function getShows()
    {
        return $this->shows;
    }

    /**
     * @param null $shows
     */
    public function setShows($shows)
    {
        $this->shows = $shows;
        return $this;
    }

    /**
     * @return null
     */
    public function getDetailedStats()
    {
        return $this->detailedStats;
    }

    /**
     * @param null $detailedStats
     */
    public function setDetailedStats($detailedStats)
    {
        $this->detailedStats = $detailedStats;
        return $this;
    }


}