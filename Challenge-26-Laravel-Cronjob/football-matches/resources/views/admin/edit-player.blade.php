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
                    <div class="card-header">Edit player</div>
                    <div class="card-body">

                        <form action="{{ route('update-player', ['id' => $players->id]) }}" method="post">
                            @csrf

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ $players['name']}}">
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Date of birth</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control"
                                       value="{{ $players['birth_date']}}">
                            </div>
                            <div class="mb-3">
                                <label for="teams_id" class="form-label">Team</label>
                                <select id="teams_id" class="form-select" name="teams_id">
                                    @foreach($teams as $team)
                                        <option value="{{ $team['id'] }}">{{ $team['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
