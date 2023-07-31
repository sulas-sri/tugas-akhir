<!-- resources/views/user_management/index.blade.php -->

@extends('layouts.main', ['title' => 'User Management', 'page_heading' => 'User Management'])

@section('content')
    <div class="container">
        <h1>User Management</h1>

        @foreach($usersByRoles as $roleName => $users)
            <h2>{{ $roleName }}</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection
