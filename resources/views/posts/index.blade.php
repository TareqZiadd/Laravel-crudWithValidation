@extends('layout.app')

@section('content')
<div class="col-12">
    <a href="/posts/create" class="btn btn-primary my-3">Add New Post</a>
    <center class="mt-4"><h1>All Posts</h1></center>
</div>


<table class="table table-bordered">
    @if (session()->has('success'))
    <center><h3 class='text-success'>{{session('success')}}</h3></center>
     @endif
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Writer_id</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ Str::limit($post->description, 100, '...') }}</td>
                <td>{{ $post->user_id }}</td>
                <td><a href="{{ url('posts/'.$post->id.'/edit') }}" class="btn btn-info">Edit</a></td>
                <td>
                    <form action="{{ url('posts/' . $post->id) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->links() }}

@endsection
