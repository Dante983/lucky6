@extends('admin_main')

@section('content')


    <div class="card" style="margin: 10px">
        <div class="card-header">Tickets:</div>
        <div class="row">
            <div>
                <a href="{{ route('show_tickets') }}"></a>
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
                @if($tickets != null)
                    @foreach($tickets as $row)

                        <tr>
                            <th>{{$row->id}}</th>
                            <th>{{$row->round_id}}</th>
                            <th>{{$row->user_numbers}}</th>
                            <th>{{$row->lucky_numbers}}</th>
                            <th>{{$row->hits}}</th>
                        </tr>
{{$row}}
                    @endforeach
                @else
                    <tr>
                        <td>No data</td>
                    </tr>
                @endif
            </table>
            {!! $tickets->links() !!}
        </div>
    </div>

@endsection
