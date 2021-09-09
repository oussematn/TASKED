<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">If you want to add a task baby, here's the palce &#128525;</h5>
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

    <div class="categories mt-5">
        @foreach($categories as $category)
        <div id="{{ $category->id}}" class="card" style="background: {{ $category->color }} !important">
            <div class="card-header text-center">
                <i class="far fa-times-circle"></i>
                {{ $category->name }}
            </div>
            <div class="card-body">
                <ul class="list-group draggable">
                    <li class="list-group-item intruder">
                    </li>
                    @foreach ($tasks as $task)
                    @if ($task->category_id == $category->id)
                    <li id="{{$task->id}}" class="list-group-item">
                        <span>{{ $task->name }}</span>
                        <div class="controllers mt-2">
                            <i class="far fa-edit"></i>
                            <i class="far fa-trash-alt"></i>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <h5>Category Name<span class="btn" data-toggle="tooltip" data-placement="right" title="Required">*</span>
                        </h5>
                        <input name="name" type=text" class="form-control" id="name">
                        <div class="alert alert-danger mt-2 d-none">Please choose a name!</div>
                        <h5 class="mt-3">Color</h5>
                        <div class="colors mb-3">
                            <div class="circle btn" style="background: #fe4a49"></div>
                            <div class="circle btn" style="background: #2ab7ca"></div>
                            <div class="circle btn" style="background: #fed766"></div>
                            <div class="circle btn" style="background: #e6e6ea"></div>
                            <div class="circle btn" style="background: #96c582"></div>
                            <div class="circle btn" style="background: #63ace5"></div>
                            <div class="circle btn" style="background: #bcd6e7"></div>
                            <div class="circle btn" style="background: #7c90c1"></div>
                            <div class="circle btn" style="background: #f6abb6"></div>
                        </div>
                        <input id="color" type="hidden" name="color" value="#fff">
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
