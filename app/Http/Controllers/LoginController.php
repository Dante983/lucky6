<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Locations;
use App\Models\Round;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    function index() {
        return view('login');
    }

    function logout() {
        Session::flush();

        Auth::logout();

        return Redirect('login');
    }


    function dashboard() {
        if(Auth::check())
        {
            $user = User::query()->where('id', '=', Auth::id())->get('location_id')->first();
            $location = Locations::query()->where('id', '=', $user->location_id)->first();
            $round_numbers = Round::query()
                ->where('location_id', '=', $location)
                ->where('active', '=', 0)
                ->latest('updated_at');

            return view('dashboard', compact('round_numbers'));
        }

        return redirect('login')->with('success', 'You need to log in to access');
    }
}
