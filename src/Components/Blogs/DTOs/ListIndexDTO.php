<?php

namespace Components\Blogs\DTOs;

use Gossamer\Core\DTOs\AbstractDTO;
use Gossamer\Core\DTOs\DTOInterface;

class ListIndexDTO extends AbstractDTO implements DTOInterface
{

    private string $fromDate;

    private string $toDate;

    private string $search;

    /**
     * @param  string  $fromDate
     * @param  string  $toDate
     * @param  string  $search
     */
    public function __construct(
        ?string $fromDate,
        ?string $toDate,
        ?string $search
    ) {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->search = $search;
    }


    /**
     * @return string
     */
    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    /**
     * @return string
     */
    public function getToDate(): string
    {
        return $this->toDate;
    }

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }


    public function getId(): string
    {
        // TODO: Implement getId() method.
    }
}
