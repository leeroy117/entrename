<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    
    public function index()
    {
        //
        // $hello = "hello world! users";
        $users = DB::table('usuarios')->get();
        return response()->json($users);
    }
}
