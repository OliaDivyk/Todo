@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            Lists!

            @foreach ($lists as $list)
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h5 class="card-title">
                            {{ $list->name }}
                        </h5>
                        <a href="/lists/{{ $list->id }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection