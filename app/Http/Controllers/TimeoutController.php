<?php

namespace App\Http\Controllers;

use App\AddVolumeParam;
use App\VolumeAttribute;
use App\IAPIConnection;
use Illuminate\Http\Request;

class TimeoutController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->sleep_time)) {
            sleep((int)$request->sleep_time);
        } else {
            sleep(60);
        }
        return array(
            'info' => '',
            'code' => 200,
            'data' => 'Time to wake up!'
        );
    }

    public function show(Request $request, $id)
    {
        return array(
            'info' => '',
            'code' => 200,
            'data' => 'Time to wake up!'
        );
    }

    public function store(Request $request)
    {
        return array(
            'info' => '',
            'code' => 200,
            'data' => 'Time to wake up!'
        );
    }

    public function slowdownPmax(Request $request)
    {
        $volumeAttribute = new VolumeAttribute('MB', 10);
        $addVolumeParam = new AddVolumeParam(30, 'FBA', $volumeAttribute, true);
        $expandStorageGroupParam = array(
            'addVolumeParam' => array(
                'num_of_vols' => $addVolumeParam->num_of_vols,
                'emulation' => $addVolumeParam->emulation,
                'volumeAttribute' => array(
                    'capacityUnit' => $volumeAttribute->capacityUnit,
                    'volume_size' => $volumeAttribute->volume_size,
                ),
                'volumeIdentifier' => array(
                    'volumeIdentifierChoice' => 'identifier_name',
                    'identifier_name' => ''
                ),
                'create_new_volumes' => true
            )
        );
        $editStorageGroupActionParam = array(
            'expandStorageGroupParam' => $expandStorageGroupParam
        );
        $postBody = array(
            'editStorageGroupActionParam' => $editStorageGroupActionParam
        );
        $conn = new IAPIConnection();
        $url = $conn->getConnectionURL() . '/sloprovisioning/symmetrix/000197802517/storagegroup/DanielTestChildGroup';
        return $conn->PUT($url, $postBody);
    }
}
