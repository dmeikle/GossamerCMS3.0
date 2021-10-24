<?php

namespace Gossamer\Core\MVC\Contracts;

interface ViewInterface
{

    public function render(array $data = array()) : array;
}