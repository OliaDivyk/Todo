@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin dashboard</h2>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <a href="/users" class="btn btn-primary">See all users</a>
            </div>
        </div>
    </div>    
</div>
@endsection