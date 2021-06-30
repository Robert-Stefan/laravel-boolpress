@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">EDIT: <a href="{{ route('adminposts.show', $post->id) }}">{{ $post->title }}</a> </h1>

        

        <div class="row">
            

            <div class="col-md-8 offset-md-2">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('adminposts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $post->title) }}">
                        @error('title')
                            <div class="feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content*</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="6">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-control" @error('category_id') is-invalid @enderror name="category_id" id="category_id">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == old('category_id', $post->category_id)) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TAGS --}}
                    <h4>Tags</h4>
                    <div class="mb-3">
                        @foreach ($tags as $tag) 
                            <span class="d-inline-block mr-3">
                                <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}"
                                    value="{{ $tag->id }}"  
                                    @if ($errors->any() && in_array($tag->id, old('tags'))) 
                                        checked
                                    @elseif (! $errors->any() && $post->tags->contains($tag->id))
                                        checked  
                                    @endif
                                >
                                <label for="tag{{ $loop->iteration }}">
                                    {{ $tag->name }}
                                </label>
                            </span>
                        @endforeach
                        @error('tags')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- POST IMAGE--}}
                    <div class="mb-3">
                    <div>
                        <label for="cover" class="form-label">Post Image</label>
                    </div>
                    
                    @if ($post->cover)
                    <div class="mb-3">
                        <img width="200" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}" >
                    </div>
                    @endif 
                    <input type="file" name="cover" id="cover">
                    @error('cover')
                        <div>{{ $message }}</div>                            
                    @enderror

                    <button class="btn btn-primary" type="submit">Update post</button>

                </form>
            </div>

        </div>
    </div>
@endsection