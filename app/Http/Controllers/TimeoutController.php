<?php

namespace App\Http\Controllers;

use App\AddVolumeParam;
use App\VolumeAttribute;
use App\IAPIConnection;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

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

    public function slowdownPmax()
    {
        $volumeAttribute = new VolumeAttribute('GB', 10);
        $addVolumeParam = new AddVolumeParam(100, 'FBA', $volumeAttribute, true);
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
        $createVolsUrl = $conn->getConnectionURL() . '/sloprovisioning/symmetrix/000197802517/storagegroup/DanielTestChildGroup';
        $conn->PUT($createVolsUrl, $postBody);
        $getVolsUrl = $conn->getConnectionURL() . '/sloprovisioning/symmetrix/000197802517/volume?storageGroupId=DanielTestChildGroup';
        $vols = $conn->GET($getVolsUrl, $postBody)['resultList']['result'];

        $volArray = array();
        foreach ($vols as $vol) {
            try {
                array_push($volArray, $vol['volumeId']);
            }
            catch(\Exception $e) {
                continue;
            }
        }
        $editStorageGroupActionParam = array(
            'removeVolumeParam' => array(
                'volumeId' => $volArray,
            )
        );
        $postBody = array(
            'editStorageGroupActionParam' => $editStorageGroupActionParam
        );
        return $conn->PUT($createVolsUrl, $postBody);
    }

    public function multipleCreation(Request $request) {
        for ($i = 0; $i < 3; $i++) {
            $this->slowdownPmax();
        }
    }
}
