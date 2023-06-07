<!-- edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname', $user->firstname) }}">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $user->lastname) }}">
        </div>
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname', $user->fullname) }}">
        </div>
        <div class="form-group">
            <label for="pan_no">PAN Number</label>
            <input type="text" name="pan_no" id="pan_no" class="form-control" value="{{ old('pan_no', $user->pan_no) }}">
        </div>
        <div class="form-group">
            <label for="emailid">Email ID</label>
            <input type="email" name="emailid" id="emailid" class="form-control" value="{{ old('emailid', $user->emailid) }}">
        </div>
        <div class="form-group">
            <label for="mobileno">Mobile Number</label>
            <input type="text" name="mobileno" id="mobileno" class="form-control" value="{{ old('mobileno', $user->mobileno) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
