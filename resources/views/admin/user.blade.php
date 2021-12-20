@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex">
        <h2>{{ $user->firstname }} {{ $user->lastname }}</h2><a class="btn btn-primary mx-3" href="/users/{{ $user->id }}/edit">Edit</a>
    </div>
</div>
@endsection