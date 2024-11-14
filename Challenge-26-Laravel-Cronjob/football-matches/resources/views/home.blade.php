@extends('layouts.app')
@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="/home">Matches</a>
    </li>

@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Matches</div>
                    <div class="card-body">

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
