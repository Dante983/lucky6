@php use Illuminate\Support\Facades\Auth; @endphp
@extends('admin_main')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <br/>
            <h3>Edit User</h3>
            <br/>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('update.user') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                   value="{{$users->name}}"/>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Email Address"
                                   value="{{$users->email}}"/>
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        @if(Auth::guard('admin')->user()->admin_type == 1)
                        <div class="form-group mb-3">
                            <input type="number" name="budget" class="form-control" placeholder="Budget"
                                   value="{{$users->budget}}"/>
                            @if($errors->has('budget'))
                                <span class="text-danger">{{ $errors->first('budget') }}</span>
                            @endif
                        </div>
                        @endif

                        @if(Auth::guard('admin')->user()->admin_type == 0)
                            <div class="form-group mb-3 dropdown">
                                <div >
                                    <select name="location" id="location_id" class="form-control">
                                        @foreach ($locations as $item)
                                            <option value="{{$item->id}}">{{$item->city}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="d-grid mx-auto">
                            <input type="hidden" name="hidden_id" value="{{$users->id}}">
                            <input type="submit" class="btn btn-primary" value="Edit">
                        </div>
                    </form>
                </div>
        </div>

@endsection
