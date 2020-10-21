<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddVolumeParam extends Model
{
    public $num_of_vols = 0;
    public $emulation = 'FBA';
    public $volumeAttribute;
    public $createNewVolumes = true;
    public $volumeIdentifier = array('volumeIdentifierChoice' => 'identifier_name', 'identifier_name' => '');

    function __construct($num_of_vols, $emulation, $volumeAttribute, $createNewVolumes)
    {
        $this->num_of_vols = $num_of_vols;
        $this->emulation = $emulation;
        $this->volumeAttribute = $volumeAttribute;
        $this->createNewVolumes = $createNewVolumes;
    }
}
