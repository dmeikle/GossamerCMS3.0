<?php

namespace Gossamer\Horus\Http;

interface HttpInterface
{

    public function setAttribute($key, $value);

    public function getAttribute($key);

    public function getAttributes();
}