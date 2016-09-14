<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ConnectionsController extends Controller
{
    public function getConnections(Request $request)
    {
      return view('connections');
    }
}
