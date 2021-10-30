<?php

namespace Library\Migration;


abstract class AbstractMigration
{
    protected $capsule;
    public function __construct() {
        $this->capsule  = new Illuminate\Database\Capsule\Manager();
        $this->capsule->addConnection([
            "driver" => "mysql",
            "host" =>"127.0.0.1",
            "database" => "gossamer3",
            "username" => "goss3_user",
            "password" => "dh7djsdk4"
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();


    }

    protected abstract function up();
}