<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function respondError($code, $message){
        return $this->respond($code, $message);
    }

    function respondSuccess($result){
        return $this->respond(200, "ok", $result);
    }

    function respondOK(){
        return $this->respond();
    }

    private function respond($code=200, $messages="ok", $data=null){
        return response()->json([
            "status" => $code == 200,
            "code" => $code,
            "message" => $messages,
            "data" => $data
        ], 200);
    }
}
