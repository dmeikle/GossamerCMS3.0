<?php

namespace tests\helpers;


trait JsonResponseHelper
{

    public function generate( string $json) {
        $uri = $this->getFullFilename();

        $f = fopen(__PHPUNIT_FILE_PATH . "$uri.txt", "w");

        fwrite($f, $json);
    }

    public function assertJsonEqualsIgnoreDates(string $json)  {
        $uri = $this->getFullFilename();

        $expected = (file_get_contents( __PHPUNIT_FILE_PATH . "$uri.txt"));
        $expected = $this->stripDates($expected);

        $json = $this->stripDates($json);
      // return array_diff(json_decode($expected,true), json_decode( $expected, true));
        $this->assertJsonStringEqualsJsonString($expected,  $json, 'json does not match');
    }

    private function getFullFilename() : string {
        $subfolder = $this->getSubfolder();
        $className = (new \ReflectionClass($this))->getShortName();
        $callingFunction = debug_backtrace()[2]['function'];

        return $subfolder . DIRECTORY_SEPARATOR . "$className.$callingFunction";
    }

    private function getSubfolder() : string {
        $namespace = (new \ReflectionClass($this))->getNamespaceName();
        $bits = explode('\\', $namespace);

        return $bits[1];
    }

    private function stripDates(string $json) {
        $expectedObj = json_decode($json);

        foreach($expectedObj as $object) {
            unset($object->created_at, $object->updated_at, $object->deleted_at);
        }

        return json_encode($expectedObj);
    }
}
