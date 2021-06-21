@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                deleted successfully.
            </div>
        @endif

        <h1>OUR POSTS</h1>
        <a class="btn btn-primary" href="{{ route('adminposts.create') }}">Create a new post</a>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>@if ($post->category) {{ $post->category->name }} @endif</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('adminposts.show', $post->id) }}">SHOW</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('adminposts.edit', $post->id) }}">EDIT</a>
                        </td>
                        <td>
                            <form class="delete-post-form" action="{{ route('adminposts.destroy', $post->id) }}" method="POST"> 
                            @csrf 
                            @method('DELETE')

                            <input class="btn btn-danger" type="submit" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- GET POSTS BY CATEGORY --}}
        <h2>Post By Category</h2>
        @foreach ($categories as $category)
            <h3 class="mt-4">{{ $category->name }}</h3>
            {{-- @dump($category->posts); --}}
            @forelse ($category->posts as $post)
                <h4>
                    <a href="{{ route('adminposts.show', $post->id) }}">{{ $post->title }}</a>
                </h4>
            @empty 
                No posts for this category. <a href="{{ route('adminposts.create') }}">Create a new post</a>
            @endforelse
        @endforeach
    </div>
@endsection