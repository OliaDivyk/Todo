@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Settings</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form id="settingsForm" action="/settings/{{ $user->id }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if(session()->has('profile_info'))
            <div class="alert alert-success col-md-6" role="alert">
                <strong>{{ session()->get('profile_info') }}</strong>
            </div>
        @endif
        <!-- build our form inputs -->
        <div class="form-group my-2 col-md-6">
            <label for="firstname">Your name</label>
            <input type="text" name="firstname" class="form-control" value=" {{ $user->firstname }} ">
        </div>

        <div class="form-group my-2 col-md-6">
            <label for="lastname">Your last name</label>
            <input type="text" name="lastname" class="form-control" value=" {{ $user->lastname }} ">
        </div>

        <div class="form-group my-2 col-md-6">
            <label for="email">E-Mail Address</label>
            <input type="email" name="email" class="form-control" value=" {{ $user->email }} ">
        </div>

        <button type="submit" class="btn btn-primary my-2">Update</button>
    </form>


    <form id="changePasswordForm" action="{{ route('change.password') }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf

        @if(session()->has('changed_password'))
            <div class="alert alert-success col-md-6" role="alert">
                <strong>{{ session()->get('changed_password') }}</strong>
            </div>
        @endif
        <!-- build our form inputs -->
        <div class="form-group my-2 col-md-6">
            <label for="old_password">Old password</label>
            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group my-2 col-md-6">
            <label for="new_password">New password</label>
            <input type="password" name="new_password" class="form-control">
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary my-2">Save</button>
    </form>
</div>
@endsection