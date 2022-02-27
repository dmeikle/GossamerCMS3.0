<?php

namespace tests\Database\Seeds;

interface SeedDataInterface
{
    public static function getData() : array;

    public function getClass();
}
