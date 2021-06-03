<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Constants\ResponseCode;
use App\Helpers\Log;

class IndexController extends Controller
{
    public function get()
    {
        $totalUser = DB::table("user")->count();

        Log::debug("abc");

        return $this->responseSuccess($totalUser);
    }
}
