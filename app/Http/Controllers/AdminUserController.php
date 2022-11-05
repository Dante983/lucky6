<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Locations;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function show(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUsers $adminUsers)
    {
        //
    }

    function admin_login() {
        return view('admin_login');
    }

    function admin_registration() {
        $locations = Locations::query()->select('id', 'city')->get();

        return view('admin_register', compact('locations'));
    }

    function admin_logout() {
        Session::flush();

        Auth::logout();

        return Redirect('admin_login');
    }

    function admin_validate_registration(Request $request) {

        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:admin_users',
            'password'     =>   'required|min:6',
            'location'     =>   'required'
        ]);

        $data = $request->all();

        AdminUsers::create([
            'name'        =>  $data['name'],
            'email'       =>  $data['email'],
            'password'    => Hash::make($data['password']),
            'location_id' => $data['location'],
            'admin_type'  => AdminUsers::REGULAR_ADMIN
        ]);

//        Locations::query()->where('id', '=', $data['location'])->increment('users');
//        Locations::query()->where('id', '=', $data['location'])->update(['updated_at' => Carbon::now()]);

        return redirect('admin_dashboard')->with('success', 'Registration Completed, now you can login');
    }

    function registration() {
        $locations = Locations::query()->select('id', 'city')->get();

        return view('registration', compact('locations'));
    }

    function admin_validate_login(Request $request) {
        $request->validate([
            'email'     =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials))
        {
            return redirect('admin_dashboard');
        }

        return redirect('admin_login')->with('success', 'Login details are not valid');
    }

    function admin_dashboard() {

        if(Auth::guard('admin')->check())
        {
            return view('admin_dashboard');
        }

        return redirect('admin_login')->with('success', 'You are not allowed to access');
    }

    function validate_registration(Request $request, AdminUsers $adminUsers) {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'location'     =>   'required'
        ]);

        $data = $request->all();
//        $get_admin_id = \Auth::id();
        $admin_id = Locations::query()->where('id', '=', $data['location'])->pluck('id')->first();

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'location_id' => $data['location'],
            'admin_id' => $admin_id
        ]);

        Locations::query()->where('id', '=', $data['location'])->increment('users');
        Locations::query()->where('id', '=', $data['location'])->update(['updated_at' => Carbon::now()]);

        return redirect('admin_dashboard')->with('success', 'Registration Completed, now you can login');
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
