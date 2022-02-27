<?php

namespace tests\Database\Seeds;

class AbstractSeedData
{

    protected static function getDatetime() : string {
        $date = new \DateTime('2000-01-01');
        return $date->format('Y-m-d H:i:s');
    }
}
