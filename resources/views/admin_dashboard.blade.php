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
    <div class="card" style="margin: 10px">
        <div class="card-header">Users:</div>
        <div class="row">
            <div>
                <a href="{{ route('show_users') }}"></a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name:</th>
                    <th>Email:</th>
                    <th>Budget:</th>
                    <th>Created at:</th>
                    @if(Auth::guard('admin')->user()->admin_type == 1)
                        <th></th>
                    @endif
                </tr>
                @if($users != null)
                    @foreach($users as $row)

                        <tr>
                            <th>{{$row->id}}</th>
                            <th>{{$row->name}}</th>
                            <th>{{$row->email}}</th>
                            <th>{{$row->budget}}</th>
                            <th>{{$row->created_at}}</th>
                            @if(Auth::guard('admin')->user()->admin_type == 1)
                            <th><a href="{{route('edit.user', $row->id)}}" class="btn btn-warning">Edit</a></th>
                            @endif
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td>No data</td>
                    </tr>
                @endif
            </table>
            {!! $users->links() !!}
        </div>
    </div>

    <div class="card">
        <div class="card-header">Tickets</div>
            <div class="card-body">
                <a href="{{ route('show_tickets') }}" class="nav-link">Show Tickets</a>
            </div>
    </div>
@if(Auth::guard('admin')->user()->admin_type == 0)
    <div class="card">
        <div class="card-header">Admins</div>
            <div class="card-body">
                <a href="{{ route('show_admins') }}" class="nav-link">Show Admins</a>
            </div>
    </div>
@endif
@endsection()
