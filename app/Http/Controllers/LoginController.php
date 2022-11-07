<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Locations;
use App\Models\Round;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function logout() {
        Session::flush();

        Auth::logout();

        return Redirect('login');
    }

    public function ticketShow() {
        $ticket = Ticket::query()->where('user_id', '=', Auth::id())
            ->leftJoin('rounds as r', 'tickets.round_id', '=', 'r.id')
            ->paginate(5);

//F
        return view('dashboard', compact('ticket'))->with('i', (\request()->input('page', 1) - 1) * 5);
    }

    public function dashboard() {
        if(Auth::check())
        {

            return view('dashboard');
        }

        return redirect('login')->with('success', 'You need to log in to access');
    }

    function validate_login(Request $request) {

        $request->validate([
            'email'     =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect('dashboard');
        }

        return redirect('login')->with('success', 'Login details are not valid');
    }
}
