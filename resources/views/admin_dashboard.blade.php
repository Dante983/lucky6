@php use Illuminate\Support\Facades\Auth; @endphp
@extends('admin_main')

@section('content')

    <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">

            Welcome {{Auth::guard('admin')->user()->name}}. You are Login in to your Lucky 6 account.
            <p>
                @if(Auth::guard('admin')->user()->admin_type == 0)
                    ovo vidi samo super admin
                @endif
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Tickets</div>
        <div class="card-body">
            <table>
                <tr>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>

@endsection('content')
