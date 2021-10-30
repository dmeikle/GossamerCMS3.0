<?php

namespace Gossamer\Pesedget\Database\Utils;

class ListResult
{
    private $maxrows;

    private $list;

    /**
     * @param $maxrows
     * @param $list
     */
    public function __construct($maxrows, $list)
    {
        $this->maxrows = $maxrows;
        $this->list = $list;
    }

    /**
     * @return mixed
     */
    public function getMaxrows()
    {
        return $this->maxrows;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }


}