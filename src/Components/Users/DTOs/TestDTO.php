<?php

namespace Components\Users\DTOs;

use Gossamer\Core\DTOs\DTOInterface;

class TestDTO implements DTOInterface
{

    private $test;

    public function __construct(string $test) {
        $this->test = $test;
    }

    /**
     * @return TestDTO
     */
    public function getTest(): string
    {
        return $this->test;
    }


    public function getId(): string
    {
        return '';
    }
}