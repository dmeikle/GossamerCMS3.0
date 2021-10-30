<?php

namespace Components\Users\Models;

use Gossamer\Core\MVC\AbstractModel;

class User extends AbstractModel
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'firstname',
        'lastname'
    ];
}