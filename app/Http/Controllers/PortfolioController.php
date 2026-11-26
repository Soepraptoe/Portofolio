<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('home', [
            'skills'      => Skill::orderBy('sort_order')->get(),
            'experiences' => Experience::orderBy('sort_order')->get(),
        ]);
    }
}
