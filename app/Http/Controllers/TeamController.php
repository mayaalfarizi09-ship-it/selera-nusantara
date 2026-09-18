<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $team = Team::active()->get();

        return view('pages.team.index', compact('team'));
    }
}
