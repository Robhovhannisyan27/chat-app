<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::check()) {
            $rooms = Room::where('protection', 1)->get();
        } else {
            $rooms = Room::where('accessibility', '1')->where('protection', 1)->get();
        }
        return view('welcome', compact('rooms'));
    }
}
