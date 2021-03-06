<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reserva;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $reservas = Reserva::where('user_id', Auth::user()->id)->get();         
        return view('home',compact('reservas'));
    }
}
