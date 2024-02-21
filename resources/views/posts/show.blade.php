@extends('layouts.app')
@section('title')
    show
@endsection
@section('content')

    <div class="card">
        <h5 class="card-header">Post Info</h5>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post->title}}</h5>
            <p class="card-text">Description: {{$post->description}} .</p>
        </div>
    </div>

    <div class="card mt-4">
        <h5 class="card-header">Post Creator's Info</h5>
        <div class="card-body">
            <h5 class="card-title">Name: {{$post->user->name}}</h5>
            <p class="card-text">Email: {{$post->user->email}}</p>
            <p class="card-text">Created At: {{$post->user->created_at}}</p>
        </div>
    </div>
@endsection
