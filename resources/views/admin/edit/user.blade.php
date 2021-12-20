@extends('layouts.app')

@section('content')
<div class="container">
    <p>Edit user</p>
    <form method="post" action="/users/{{ $user->id }}" class="needs-validation" novalidate enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if(session()->has('message'))
            <div class="alert alert-success col-md-6" role="alert">
                <strong>{{ session()->get('message') }}</strong>
            </div>
        @endif
        <div class="form-group my-2 col-md-6">
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}">
        </div>

        <div class="form-group my-2 col-md-6">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
        </div>

        <div class="form-group my-2 col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="my-2 col-md-6">
            <label for="subscriptions">User Subscription - {{ $user->subscription->name_subscription }}</label>
            <select class="form-select" aria-label="Subscriptions" name="subscription">
                <option value="BASIC">BASIC</option>
                <option value="IMPROVER">IMPROVER</option>
                <option value="PREMIUM">PREMIUM</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary my-2">Save</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection