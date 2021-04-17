<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Ticket;
use App\User;
use Illuminate\Http\Request;
use App\Models\Access;
use Auth;
use AccessHelp;

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
        $sts       = Auth::user()->status;
        if ($sts == '0'){
            Auth::logout();
            return redirect('/')->with('alert-success', 'Your account is not active, please contact your administrator');
        }
        $dosen      = Dosen::all()->count();
        $new     = Ticket::where('status_id', 4)->count();
        $on     = Ticket::where('status_id', 3)->count();
        $done     = Ticket::where('status_id', 2)->count();
        $pend     = Ticket::where('status_id', 1)->count();
        return view('home', ['dosen' => $dosen, 'new' => $new, 'on' => $on, 'done' => $done, 'pending' => $pend]);
    }
}
