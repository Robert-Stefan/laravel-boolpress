@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>

        {{-- @dump($post->category) --}}
        @if($post->category)
        <h3>Category: {{ $post->category->name }}</h3>
        @endif

        <div class="mb-5">
            <a class="btn btn-warning" href="{{ route('adminposts.edit', $post->id) }}">Edit post</a>
        </div>


        {{-- POST IMAGE--}}
        <div class="mb-5 row">
            @if($post->cover)
                <div class="col-md-6">
                <img class="img-fluid" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                </div>
            </div>
            @endif
            <div class="{{ ($post->cover == null) ? 'col' : 'col-md-6'}}">
            {{ $post->content }}
            </div>
            {{-- POST TAGS --}}
        @if(count($post->tags) > 0)
        <div class="mt-5">
            <h4>Tags</h4>
            @foreach ($post->tags as $tag)
                <span class="badge badge-primary">{{ $tag->name }}</span>                
            @endforeach
        </div>
        @endif

        </div>

        
    </div>
    
@endsection