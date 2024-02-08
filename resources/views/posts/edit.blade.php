@extends('layouts.app')
@section('title') Update @endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('posts.update', $post->id)}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input value="{{$post->title}}" required type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea  required class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{$post->description}}</textarea>
        </div>
        <div class="mb-3">
            <select required class="form-select" aria-label="Creator" name="posted_by">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button class="btn btn-info">Update</button>
        </div>
    </form>

@endsection
