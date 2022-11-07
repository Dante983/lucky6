@extends('admin_main')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Admin Registration</div>
                <div class="card-body">
                    <form action="{{ route('admin_validate_registration') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name" />
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Email Address" />
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" />
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

{{--                        <div class="form-group mb-3">--}}
{{--                            <select name="location" id="location_id">--}}
{{--                                @foreach ($locations as $item)--}}
{{--                                    <option value="{{$item->id}}">{{$item->city}} </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}

{{--                        </div>--}}

                        <div class="form-group mb-3 dropdown">
                            <div >
                                <input name="location" type="text" class="form-control" placeholder="Location">
                                @if($errors->has('location'))
                                    <span class="text-danger">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

@endsection('content')
