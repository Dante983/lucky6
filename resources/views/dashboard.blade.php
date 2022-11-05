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
    </style>

    <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">

            Welcome {{Auth::user()->name}}. You are Login in to your Lucky 6 account.
        </div>
    </div>

{{--    <div class="card-body" style="position: relative; float: right">Vrijeme</div>--}}
    <div class="card" style="margin-top: 50px">
        <div class="card-header">Tickets</div>
        <div class="card-body">

            <div >
                <div name="round_numbers" id="round_number" class="form-control">
                    @foreach ($round_numbers as $item)
                        <p> {{$item}} </p>
                    @endforeach
                </div>
            </div>
            <table class="GeneratedTable">
                <tbody>
                <tr>
                    <td><input type="checkbox" name="number[1]">Cell</td>
                    <td><input type="checkbox" name="number[2]">Cell</td>
                    <td><input type="checkbox" name="number[3]">Cell</td>
                    <td><input type="checkbox" name="number[4]">Cell</td>
                    <td><input type="checkbox" name="number[5]">Cell</td>
                    <td><input type="checkbox" name="number[6]">Cell</td>
                    <td><input type="checkbox" name="number[7]">Cell</td>
                    <td><input type="checkbox" name="number[8]">Cell</td>
                    <td><input type="checkbox" name="number[9]">Cell</td>
                    <td><input type="checkbox" name="number[10]">Cell</td>
                    <td><input type="checkbox" name="number[11]">Cell</td>
                    <td><input type="checkbox" name="number[12]">Cell</td>
                    <td><input type="checkbox" name="number[13]">Cell</td>
                    <td><input type="checkbox" name="number[14]">Cell</td>
                    <td><input type="checkbox" name="number[15]">Cell</td>
                    <td><input type="checkbox" name="number[16]">Cell</td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>6 <input type="checkbox" name="number[6]"></td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td>Cell</td>
                    <td style="color: white; background-color: white; border-radius: 0;"></td>
                    <td style="color: white; background-color: white; border-radius: 0;"></td>
                </tr>
                </tbody>
            </table>
{{--            <table>--}}
{{--                <tbody>--}}
{{--                <?php for ($i = 0; $i < 10; $i++) : ?>--}}
{{--                <tr>--}}
{{--                        <?php for ($k = 0; $k < 10; $k++) : ?>--}}
{{--                        <?php $num = rand(1, 10); ?>--}}
{{--                    <td style="color: <?= $num < 5 ? 'red' : 'green'; ?>; padding-bottom: 5px; padding-left: 10px"><?= $num; ?></td>--}}
{{--                    <?php endfor; ?>--}}
{{--                </tr>--}}
{{--                <?php endfor; ?>--}}
{{--                </tbody>--}}
{{--            </table>--}}
        </div>
    </div>

    <div class="card" style="margin-top: 50px; float: left; width: 640px;height: 100%">
        <div class="card-header">My Tickets</div>
        <div class="card-body">
            <p>Prvi tiket</p>
            <p>drugi tiket</p>
        </div>
    </div>

    <div class="card" style="margin-top: 50px; float: right; width: 640px">
        <form method="POST" action="{{ route("submit.ticket") }}">
            @csrf

            <label for="ticketNum">Choose Ticket Numbers:</label><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="number" min="1" max="48" step="1" id="ticketNum" name="numbers[]"><br>
            <input type="submit">
        </form>
    </div>

@endsection('content')
