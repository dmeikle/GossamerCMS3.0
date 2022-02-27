<?php

namespace Components\Users\Models;

use Gossamer\Core\MVC\AbstractModel;

class User extends AbstractModel
{
    protected $primaryKey = 'id';

    //public $timestamps = true;

    protected $dateFormat = 'Y/m/d H:i:s';

    protected $fillable = [
        'id',
        'firstname',
        'lastname'
    ];
}
