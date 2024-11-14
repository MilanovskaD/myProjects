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
                    <div class="card-header">Players</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <a href="/add-player" class="btn btn-info float-end clearfix">Add new Player</a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Date of birth</th>
                                <th scope="col">Team</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $player)

                                <tr>
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->birth_date }}</td>
                                    <td>
                                        {{ $player->team->name ?? 'No team assigned' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('edit-player', ['id' => $player->id]) }}"
                                           class="text-decoration-none">Edit</a>
                                        <a href="{{ route('delete-player', ['id' => $player->id]) }}"
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
