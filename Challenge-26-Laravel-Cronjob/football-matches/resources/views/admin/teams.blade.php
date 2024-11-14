@extends('layouts.app')
@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="/admin.dashboard">Matches</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/teams">Teams</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/players">Players</a>
    </li>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Teams</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <a href="/add-team" class="btn btn-info float-end clearfix">Add new Team</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Year Founded</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->foundation_year }}</td>
                                    <td>
                                        <a href="{{ route('edit-team', ['id' => $team->id]) }}"
                                           class="text-decoration-none">Edit</a>
                                        <a href="{{ route('delete-team', ['id' => $team->id]) }}"
                                           class="text-decoration-none">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
