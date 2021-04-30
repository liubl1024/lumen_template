<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public function get(){
        $totalUser = DB::table("user")->count();
        Log::debug("aaa");
        return $totalUser;
    }
}
