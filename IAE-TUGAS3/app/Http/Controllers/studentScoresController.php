<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\studentScores;

class studentScoresController extends Controller
{
    public function index ()
    {
        $request = studentScores::all();
        return response()->json($request);
    }
}
