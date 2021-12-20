@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $list->name }}</h2>
    <p>{{ $list->description }}</p>
    <input type="hidden" id="list-id" value="{{ $list->id }}">
    <div class="row">
        <div class="col-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTask">
                New Task
            </button>
        </div>
    </div>
    
    <div class="row justify-content-center my-4">
        @foreach ($cards as $card)
        <div class="col-4 my-2">
            <div class="card" style="height: 100%">
                <div class="card-body justify-content-between" style="display: flex;flex-direction: column;">
                    <div>
                        <h5 class="card-title">{{ $card->name }}</h5>
                        @if ($card->description)
                            <p class="card-text">{{ $card->description }}</p>
                        @endif
                    </div>
                    <div>
                        @if ($card->priority)
                            <span class="badge bg-secondary">{{ $card->priority }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning" onclick="editTask({{ $card->id }})" data-toggle="modal" data-target="#editTask" type="button"><span class="material-icons">edit</span></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal for edit List -->
    <div class="modal fade" id="editTask" tabindex="-1" role="dialog" aria-labelledby="editTaskModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModal">Edit Task</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="mb-2" action="#">
                    @csrf
                    <input type="hidden" name="list-id" id="list-id">
                    <div class="row">
                        <label for="name" class="col-form-label text-md-right">{{ __('Task Title') }}</label>
                    </div>
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>

                    <div class="row">
                        <label for="list_description" class="col-form-label text-md-right">{{ __('Short description') }}</label>
                    </div>
                    <div>
                        <textarea id="list_description" type="text" class="form-control @error('list_description') is-invalid @enderror" name="list_description" value="{{ old('list_description') }}" required autocomplete="list_description" autofocus></textarea>
                    </div>

                    <div class="d-flex justify-content-between my-2">
                        <div class="priority">
                            <input type="radio" id="priority-easy" value="EASY" name="priority-radio">
                            <button class="radio-button type-green" type="button">
                                <label for="priority-easy">Easy</label>
                            </button>
                        </div>
                        <div class="priority">
                            <input type="radio" id="priority-normal" value="NORMAL" name="priority-radio">
                            <button class="radio-button type-orange" type="button">
                                <label for="priority-normal">Normal</label>
                            </button>
                        </div>
                        <div class="priority">
                            <input type="radio" id="priority-important" value="IMPORTANT" name="priority-radio">
                            <button class="radio-button type-red" type="button">
                                <label for="priority-important">Important</label>
                            </button>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateTask()">
                                {{ __('Save') }}
                        </button>
                    </div>  
                </form>
            </div>
            
            </div>
        </div>
    </div>

     <!-- Modal for add New List -->
     <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="newTaskModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTaskModal">Add new Task</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="addCardResponse"></div>
                <form method="POST" class="mb-2" action="#">
                    @csrf

                    <div class="row">
                        <label for="name" class="col-form-label text-md-right">{{ __('Task Title') }}</label>
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
                        <label for="card_description" class="col-form-label text-md-right">{{ __('Description') }}</label>
                    </div>
                    <div>
                        <textarea id="card_description" type="text" class="form-control @error('card_description') is-invalid @enderror" name="card_description" value="{{ old('card_description') }}" required autocomplete="card_description" autofocus></textarea>

                        @error('cards_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between my-2">
                        <div class="priority">
                            <input type="radio" id="priority-easy" value="EASY" name="priority-radio">
                            <button class="radio-button type-green" type="button">
                                <label for="priority-easy">Easy</label>
                            </button>
                        </div>
                        <div class="priority">
                            <input type="radio" id="priority-normal" value="NORMAL" name="priority-radio">
                            <button class="radio-button type-orange" type="button">
                                <label for="priority-normal">Normal</label>
                            </button>
                        </div>
                        <div class="priority">
                            <input type="radio" id="priority-important" value="IMPORTANT" name="priority-radio">
                            <button class="radio-button type-red" type="button">
                                <label for="priority-important">Important</label>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="addTask()">
                                {{ __('New task') }}
                        </button>
                    </div>  
                </form>
            </div>
            
            </div>
        </div>
    </div>
</div>
@endsection