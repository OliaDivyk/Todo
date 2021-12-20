@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Users list</h2>
    @foreach ($users as $key => $user)
        <div class="card my-2">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <h5 class="card-title">
                        {{ $key + 1 }}. {{ $user->firstname }} {{ $user->lastname }}
                    </h5>
                    <p>{{ $user->subscription->name_subscription }}</p>
                </div>
                <div>
                    <a href="/users/{{ $user->id }}" class="btn btn-primary" type="button"><span class="material-icons">visibility</span></a>
                    <a href="/users/{{ $user->id }}/edit" class="btn btn-warning" type="button"><span class="material-icons">edit</span></a>
                    @if ($user->account_status === 0)
                        <button class="btn btn-danger" onclick="changeUserStatus({{ $user->id }}, {{ $user->account_status }})" type="button">
                            <span class="material-icons">lock</span>
                        </button>
                    @else
                        <button class="btn btn-success" onclick="changeUserStatus({{ $user->id }}, {{ $user->account_status }})" type="button">
                            <span class="material-icons">lock_open</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection