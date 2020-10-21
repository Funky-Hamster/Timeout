<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolumeAttributes extends Model
{
    public $capacityUnit = '';
    public $volume_size = 0.0;

    function __construct($capacityUnit, $volume_size)
    {
        $this->capacityUnit = $capacityUnit;
        $this->volume_size = $volume_size;
    }
}
