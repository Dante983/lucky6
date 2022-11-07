<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Locations;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
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
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if (Auth::guard('admin')->user()->admin_type == 1){
            $users = User::find($id);
            return view('edit_user', compact('users'));
        } else {
            $users = AdminUsers::find($id);
            $locations = Locations::all();
            return view('edit_user', compact('users', 'locations'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminUsers  $adminUsers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->all();
//        $locations =

        if (Auth::guard('admin')->user()->admin_type == 1) {
            $form_data = array(
                'name' => $data['name'],
                'email' => $data['email'],
                'budget' => $data['budget'],
            );
        } else {
            $form_data = array(
                'name' => $data['name'],
                'email' => $data['email'],
                'location_id' => $data['location'],
            );
        }

        User::whereId($data['hidden_id'])->update($form_data);

        return redirect('admin_dashboard')->with('success', 'User Updated');
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

        Auth::guard('admin')->logout();

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

        Locations::query()->insert([
            'city' => $data['location'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $last_id = Locations::query()->latest('created_at')->first('id');

        AdminUsers::create([
            'name'        =>  $data['name'],
            'email'       =>  $data['email'],
            'password'    => Hash::make($data['password']),
            'location_id' => $last_id->id,
            'admin_type'  => AdminUsers::REGULAR_ADMIN
        ]);

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

    function validate_registration(Request $request) {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'number'        =>  'integer|size:6'
        ]);

        $data = $request->all();
        $admin_id = Auth::guard('admin')->id();
        $admin_location = AdminUsers::query()
            ->where('id', '=', Auth::guard('admin')->id())
            ->pluck('location_id')->first();

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password']),
            'location_id' => $admin_location,
            'admin_id' => $admin_id,
            'budget' => $data['budget']
        ]);

        Locations::query()->where('id', '=', $admin_location)->increment('users');
        Locations::query()->where('id', '=', $admin_location)->update(['updated_at' => Carbon::now()]);

        return redirect('admin_dashboard')->with('success', 'Registration Completed, now you can login');
    }

    public function showUsers() {
        if (Auth::guard('admin')->user()->admin_type == 0) {
            $users = User::query()->paginate(5);
        } else {
            $users = User::query()
                ->where('admin_id', '=', Auth::guard('admin')->id())
                ->paginate(5);
        }

        return view('admin_dashboard', compact('users'))->with('i', (\request()->input('page', 1) - 1) * 5);
    }

    public function showTickets() {
        if (Auth::guard('admin')->user()->admin_type == 0) {
            $tickets = Ticket::query()
                ->leftJoin('rounds as r', 'tickets.round_id', '=', 'r.id')
                ->paginate(15);
        } else {
            $tickets = Ticket::query()
                ->where('location_id', '=', Auth::guard('admin')->user()->location_id)
                ->paginate(15);
        }

        return view('admin_tickets', compact('tickets'))->with('i', (\request()->input('page', 1) - 1) * 5);
    }

    public function showAdmins() {
        $admins = AdminUsers::query()->where('id', '!=', Auth::guard('admin')->id())->paginate(15);


        return view('super_admin', compact('admins'))->with('i', (\request()->input('page', 1) - 1) * 5);
    }
}
