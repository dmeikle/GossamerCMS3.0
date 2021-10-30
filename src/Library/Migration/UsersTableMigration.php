<?php

namespace Library\Migration;

class UsersTableMigration extends AbstractMigration
{

    protected function up()
    {
        $this->capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('api_key')->nullable()->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }
}