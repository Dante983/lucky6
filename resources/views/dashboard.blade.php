@php use Illuminate\Support\Facades\Auth; @endphp
@extends('main')

@section('content')
    <style>
        table.GeneratedTable {
            width: 100%;
            background-color: #e3f2fd;
            border-collapse: collapse;
            border-width: 2px;
            border-color: #ffffff;
            border-style: solid;
            color: #000000;
            height: 250px;
            text-align: center;
        }

        table.GeneratedTable td, table.GeneratedTable th {
            border-width: 2px;
            border-color: #ffffff;
            border-style: solid;
            padding: 3px;
            border-radius: 15px;
        }
        p {
            text-align: center;
            font-size: 60px;
            margin-top: 0px;
        }
    </style>

    <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">

            Welcome {{Auth::user()->name}}. You are Login in to your Lucky 6 account.
        </div>
    </div>

    <div class="card" style="margin: 10px">
        <div class="card-header">Tickets:</div>
        <div class="row">
            <div>
                <a href="{{ route('ticket_show') }}"></a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Round:</th>
                    <th>Yours Numbers:</th>
                    <th>Round Numbers:</th>
                    <th>Hits:</th>
                </tr>
                @if($ticket != null)
                    @foreach($ticket as $row)

                        <tr>
                            <th>{{$row->id}}</th>
                            <th>{{$row->round_id}}</th>
                            <th>{{$row->user_numbers}}</th>
                            <th>{{$row->lucky_numbers}}</th>
                            <th>{{$row->hits}}</th>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td>No data</td>
                    </tr>
                @endif
            </table>
            {!! $ticket->links() !!}
        </div>
    </div>

    <div class="card" style="display: inline-block; margin: 10px">
        <div class="card-header">Create New Ticket:</div>
        <div class="card-body">
        <form method="POST" action="{{ route("submit.ticket") }}">
            @csrf

            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="submit">
        </form>
    </div>
    </div><div class="card" style="float: right;display: inline-block; margin: 10px">
        <div class="card-header">Time till new round:</div>
        <div class="card-body">
            <div class="countdown"></div>
    </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        var timer2 = "5:01";
        var interval = setInterval(function() {

            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            if (minutes < 0) clearInterval(interval);
            //check if both minutes and seconds are 0
            if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
            timer2 = minutes + ':' + seconds;
        }, 1000);

    </script>

@endsection('content')
