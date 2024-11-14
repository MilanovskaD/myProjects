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
                    <div class="card-header">Create new match</div>
                    <div class="card-body">

                        <form action="{{ route('update-match', ['id' => $matches['id']]) }}" method="post">
                            @csrf

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="home_team" class="form-label">Home Team</label>
                                <select id="home_team" class="form-select" name="home_team">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $team->id == $matches->home_team ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="guest_team" class="form-label">Guest Team</label>
                                <select id="guest_team" class="form-select" name="guest_team">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $team->id == $matches->guest_team ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{$matches['date']}}">
                            </div>

                            <div class="mb-3">
                                <label for="result">Result</label>
                                <input type="text" name="result" id="result" class="form-control" value="{{$matches['result']}}">
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
