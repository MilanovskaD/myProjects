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
                    <div class="card-header">Matches</div>
                    <div class="card-body">

                        <a href="/add-match" class="btn btn-info float-end clearfix">Add new Match</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Team 1</th>
                                <th scope="col">Team 2</th>
                                <th scope="col">Date</th>

                                <th scope="col">Result</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($matches as $match)

                                <tr>
                                    <td>{{ $match->homeTeam->name  }}</td>
                                    <td>{{ $match->guestTeam->name  }}</td>
                                    <td>{{ $match->date}}</td>
                                    <td> {{ $match->result ?? '//'}}</td>
                                    <td>
                                        <a href="{{ route('edit-match', ['id' => $match->id]) }}"
                                           class="text-decoration-none">Edit</a>
                                        <a href="{{ route('delete-match', ['id' => $match->id]) }}"
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
