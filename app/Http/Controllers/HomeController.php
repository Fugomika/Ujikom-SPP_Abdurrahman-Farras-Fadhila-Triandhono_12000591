<?php

namespace App\Http\Controllers;

use App\Models\{PaymentViews,StudentViews,Classe};
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $p = PaymentViews::count();
        $s = StudentViews::count();
        $c = Classe::count();
        return view('home',compact('p','s','c'));
    }
}
