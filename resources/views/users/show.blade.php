<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>User Details</h1>

    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>First Name:</th>
            <td>{{ $user->firstname }}</td>
        </tr>
        <tr>
            <th>Last Name:</th>
            <td>{{ $user->lastname }}</td>
        </tr>
        <tr>
            <th>Full Name:</th>
            <td>{{ $user->fullname }}</td>
        </tr>
        <tr>
            <th>PAN Number:</th>
            <td>{{ $user->pan_no }}</td>
        </tr>
        <tr>
            <th>Email ID:</th>
            <td>{{ $user->emailid }}</td>
        </tr>
        <tr>
            <th>Mobile Number:</th>
            <td>{{ $user->mobileno }}</td>
        </tr>
    </table>
@endsection
