<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Locations;
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

    function registration() {
        $locations = Locations::query()->select('id', 'city')->get();

        return view('registration', compact('locations'));
    }

    function logout() {
        Session::flush();

        Auth::logout();

        return Redirect('login');
    }

    function validate_registration(Request $request) {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'location'     =>   'required'
        ]);

        $data = $request->all();

        $get_admin_id = AdminUsers::query()->where('location_id', '=', $data['location'])->get('id')->toArray();

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'location_id' => $data['location'],
//            'admin_id' => $data
        ]);

        $admin_id = Locations::query()->where('id', '=', $data['location'])->get();

        Locations::query()->where('id', '=', $data['location'])->increment('users');
        Locations::query()->where('id', '=', $data['location'])->update(['updated_at' => Carbon::now()]);

        return redirect('login')->with('success', 'Registration Completed, now you can login');
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

    function dashboard() {
        if(Auth::check())
        {
            return view('dashboard');
        }

        return redirect('login')->with('success', 'You need to log in to access');
    }
}
