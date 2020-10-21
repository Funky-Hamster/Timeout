<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditStorageGroupActionParam extends Model
{
    public $addVolumeParam;
    public $removeVolumeParam;
    function __construct($addVolumeParam, $removeVolumeParam){
        $this->addVolumeParam = $addVolumeParam;
        $this->removeVolumeParam = $removeVolumeParam;
    }
}
