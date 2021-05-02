<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Constants\ResponseCode;

class IndexController extends Controller
{
    public function get()
    {
        $totalUser = DB::table("user")->count();

        return $this->responseSuccess($totalUser);
    }
}
