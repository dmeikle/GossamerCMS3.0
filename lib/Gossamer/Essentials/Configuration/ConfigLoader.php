<?php

namespace Gossamer\Essentials\Configuration;

interface ConfigLoader
{

    public function setFilePath($ymlFilePath);

    public function loadConfig();
}