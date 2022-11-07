<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return false|Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {

        if (Auth::user()->budget < 1) {

//            window.alert()
            return false;
        }

        try {
            $request->validate([
                'numbers' => 'required|nullable|array|min:1|max:48',
                'numbers.*' => 'required|int|distinct'
            ]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        $user = User::query()->where('id', '=', Auth::id())->first();
        $round = Round::query()
            ->where('active', '=', 1)
            ->where('location_id' ,'=', $user->location_id)
            ->first();
        $data = $request->all();

        Ticket::query()->insert([
            'round_id' => $round->id,
            'user_id' => $user->id,
            'user_numbers' => json_encode($data['numbers']),
            'location_id' => $user->location_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return Redirect('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
