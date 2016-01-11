<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
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
     * @return Response
     */
    public function index()
    {
        if(Auth::user()->role == 'Admin'){
            return view('home');    
        }else if(Auth::user()->role == 'Customer'){
            return redirect('/product');
        }
    }
}
