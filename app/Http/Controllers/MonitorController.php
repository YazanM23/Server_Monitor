<?php

namespace App\Http\Controllers;

use App\Models\Monitors;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    //
    public function getLastInfo()
    {
        $informations = Monitors::orderBy('id', 'desc')->first();
        if ($informations) {
            return view('index', ['informations' => $informations]);
        }
        return view('index');
    }
}
