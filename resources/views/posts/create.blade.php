@extends('layouts.app')
@section('title')
    create
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input value="{{old('title')}}" type="text" class="form-control" name="title" id="exampleFormControlInput1"
                   placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description"
                      rows="3">{{old('title')}}</textarea>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Creator" name="posted_by">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button class="btn btn-success">Create</button>
        </div>
    </form>

@endsection
