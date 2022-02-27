<?php

namespace Components\Dashboard\Models;

use Gossamer\Core\MVC\AbstractModel;

class SettingGroup extends AbstractModel
{
    protected $primaryKey = 'id';

    protected $attributes = [
        'settings' => array()
    ];

    protected $fillable = [
        'settings',
        'id',
        'name',
        'description',
        'priority',
        'is_active'
    ];

    public function setSettings($settings) {
        $this->attributes['settings'] = $settings;
    }
    public function getSettings() {
        return $this->attributes['settings'];
    }
}
