<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header">Add New Task</div>
        <div class="card-body">
            <h5 class="card-title">Task</h5>
            <form action="/tasks" method="POST">
                @csrf
                <input name="name" type=text" class="form-control" id="name">
                @if ($errors->has('name'))
                <div class="alert alert-danger mt-2">{{$errors->first('name')}}</div>
                @endif
                <h5 class="card-title mt-3">Category</h5>
                <div class="mt-3 choose-add-category">
                    <select name="category" class="form-control" id="category">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if ($loop->first) selected="selected"
                            @endif>{{$category->name}}
                        </option>
                        @endforeach
                    </select>
                    <div class="btn btn-outline-dark" data-toggle="modal" data-target="#addCategory">Add Category</div>
                </div>

                @if ($errors->has('category'))
                <div class="alert alert-danger mt-2">{{$errors->first('category')}}</div>
                @endif
                <button type="submit" class="btn btn-outline-dark mt-3">
                    <i class="fa fa-plus"></i> Add Task
                </button>
            </form>
        </div>
    </div>
    <h3 class="mt-5">Tasks</h3>

    <ul class="list-group list-group-flush">
        {{-- @foreach ($tasks as $task)
        <li class="list-group-item">
            {{$task->name}}
        <div class="float-right ml-2">
            <form action="/tasks/{{$task->id}}" method="POST" name="delete_task">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                </button>
            </form>
        </div>
        <div class="float-right">
            <form action="/tasks/{{$task->id}}" method="POST" name="edit_task" class="edit-form">
                @csrf
                @method('PUT')
                <input type="hidden" class="new_task_value" name="name">
                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i>
                </button>
            </form>
        </div>
        </li>
        @endforeach --}}
    </ul>
    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/categories" method="POST" class="add-category-form">
                        @csrf
                        <h5>Category Name</h5>
                        <input name="name" type=text" class="form-control" id="name">
                        @if ($errors->has('name'))
                        <div class="alert alert-danger mt-2">{{$errors->first('name')}}</div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit-btn-category-fake">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection