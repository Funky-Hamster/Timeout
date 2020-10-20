<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeoutController extends Controller
{
    public function index(Request $request) {
        if(isset($request->sleep_time)) {
            sleep((int)$request->sleep_time);
        } else {
            sleep(60);
        }
        return array(
            "info" => "",
            "code" => 200,
            "data" => "Time to wake up!"
        );
    }

    public function show(Request $request, $id) {
        return array(
            "info" => "",
            "code" => 200,
            "data" => "Time to wake up!"
        );
    }

    public function store(Request $request) {
        return array(
            "info" => "",
            "code" => 200,
            "data" => "Time to wake up!"
        );
    }

    public function slowdownPmax(Request $request) {

    }
}
