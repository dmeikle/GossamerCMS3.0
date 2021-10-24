<?php

namespace Gossamer\Core\MVC;

use Gossamer\Core\MVC\Contracts\ModelInterface;
use Gossamer\Core\MVC\Contracts\ViewInterface;

class AbstractController
{

    protected $model;

    protected $view;

    public function __construct(ModelInterface $model, ViewInterface $view) {
        $this->model = $model;
        $this->view = $view;
    }

    protected function render($data = array()) : array {

    }
}