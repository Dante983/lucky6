@extends('admin_main')

@section('content')


    <div class="card" style="margin: 10px">
    <div class="card-header">Users:</div>
    <div class="row">
        <div>
            <a href="{{ route('show_admins') }}"></a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name:</th>
                <th>Email:</th>
                <th>Location:</th>
                <th>Created at:</th>
            </tr>
            @if($admins != null)
                @foreach($admins as $row)

                    <tr>
                        <th>{{$row->id}}</th>
                        <th>{{$row->name}}</th>
                        <th>{{$row->email}}</th>
                        <th>{{$row->location_id}}</th>
                        <th>{{$row->created_at}}</th>
                    </tr>

                @endforeach
            @else
                <tr>
                    <td>No data</td>
                </tr>
            @endif
        </table>
        {!! $admins->links() !!}
    </div>
</div>
@endsection
