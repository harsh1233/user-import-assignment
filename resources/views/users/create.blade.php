<!-- create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
        </div>
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname') }}">
        </div>
        <div class="form-group">
            <label for="pan_no">PAN Number</label>
            <input type="text" name="pan_no" id="pan_no" class="form-control" value="{{ old('pan_no') }}">
        </div>
        <div class="form-group">
            <label for="emailid">Email ID</label>
            <input type="email" name="emailid" id="emailid" class="form-control" value="{{ old('emailid') }}">
        </div>
        <div class="form-group">
            <label for="mobileno">Mobile Number</label>
            <input type="text" name="mobileno" id="mobileno" class="form-control" value="{{ old('mobileno') }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
