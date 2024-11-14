@extends('layouts.app')
@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="/admin.dashboard">Matches</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/teams">Teams</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">Players</a>
    </li>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit team</div>
                    <div class="card-body">

                        <form action="{{ route('update-team', ['id' => $teams->id]) }}" method="post">
                            @csrf

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{$teams['name']}}">
                            </div>
                            <div class="mb-3">
                                <label for="foundation_year" class="form-label">Year Founded</label>
                                <input type="date" id="foundation_year" name="foundation_year" class="form-control"
                                       value="{{$teams['foundation_year']}}">
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
