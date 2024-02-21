@extends('layouts.app')

@section('title')
    index
@endsection

@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td>
                    <div class="flex-row">
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-info px-2">View</a>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary px-2">Edit</a>
                        <form style="display: inline" action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger px-2" onclick="confirmDelete(this.form)">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete(form) {
            if (confirm("Are you sure you want to delete?")) {
                // User clicked OK, proceed with delete action
                form.submit();
            } else {
                // User clicked Cancel, do nothing
                return false;
            }
        }
    </script>

@endsection
