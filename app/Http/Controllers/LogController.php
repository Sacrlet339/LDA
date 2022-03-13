<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){

        $logs = Log::join('users','users.id','logs.completed_by')->select('logs.*','users.firstname','users.lastname')->get();

        return view('logs', compact('logs'));
    }
}
