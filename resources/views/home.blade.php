@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newList">
                        New List
                    </button>
                    @foreach ($lists as $list)
                        <div class="card my-2">
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">
                                        {{ $list->name }}
                                    </h5>
                                    <p class="card-text">{{ $list->description }}</p>
                                </div>
                                <div>
                                    <a href="/lists/{{ $list->id }}" class="btn btn-primary"><span class="material-icons">visibility</span></a>
                                    <button class="btn btn-warning" onclick="editList({{ $list->id }})" data-toggle="modal" data-target="#editList" type="button"><span class="material-icons">edit</span></button>
                                    <button class="btn btn-danger" onclick="removeList({{ $list->id }})" type="button"><span class="material-icons">delete_outline</span></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Modal for edit List -->
                    <div class="modal fade" id="editList" tabindex="-1" role="dialog" aria-labelledby="editListModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editListModal">Edit List</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="mb-2" action="#">
                                    @csrf
                                    <input type="hidden" name="list-id" id="list-id">
                                    <div class="row">
                                        <label for="name" class="col-form-label text-md-right">{{ __('List Title') }}</label>
                                    </div>
                                    <div>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <label for="list_description" class="col-form-label text-md-right">{{ __('Short description') }}</label>
                                    </div>
                                    <div>
                                        <textarea id="list_description" type="text" class="form-control @error('list_description') is-invalid @enderror" name="list_description" value="{{ old('list_description') }}" required autocomplete="list_description" autofocus></textarea>

                                        @error('list_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="updateList()">
                                                {{ __('Save') }}
                                        </button>
                                    </div>  
                                </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>

                    <!-- Modal for add New List -->
                    <div class="modal fade" id="newList" tabindex="-1" role="dialog" aria-labelledby="newListModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newListModal">Add new List</h5>
                                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="addListResponse"></div>
                                <form method="POST" class="mb-2" action="#">
                                    @csrf

                                    <div class="row">
                                        <label for="name_list" class="col-form-label text-md-right">{{ __('List Title') }}</label>
                                    </div>
                                    <div>
                                        <input id="name_list" type="text" class="form-control @error('name_list') is-invalid @enderror" name="name_list" value="{{ old('name_list') }}" required autocomplete="name_list" autofocus>

                                        @error('name_list')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <label for="list_description" class="col-form-label text-md-right">{{ __('Short description') }}</label>
                                    </div>
                                    <div>
                                        <textarea id="list_description" type="text" class="form-control @error('list_description') is-invalid @enderror" name="list_description" value="{{ old('list_description') }}" required autocomplete="list_description" autofocus></textarea>

                                        @error('list_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="addList">
                                                {{ __('New list') }}
                                        </button>
                                    </div>  
                                </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
