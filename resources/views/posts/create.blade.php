@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
    integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($post) ? 'Edit Post' : 'Create Post' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            @isset($post)
            @method('PATCH')
            @endisset

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ $post->title ?? old('title') }}" autofocus>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="2"
                    class="form-control @error('description') is-invalid @enderror">{{ $post->description ?? old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ $post->content ?? old('content') }}">
                <trix-editor input="content"></trix-editor>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="published_at">Pubished At</label>
                <input type="text" id="published_at" class="form-control @error('published_at') is-invalid @enderror"
                    name="published_at" value="{{ $post->published_at ?? old('published_at') }}">
                @error('published_at')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            @if(isset($post))
            <div class="form-group">
                <img src="{{ asset("storage/$post->image") }}" class="w-50 image-view" alt="{{ $post->title }}">
            </div>
            @else
            <div class="form-group">
                <img src="" class="w-50 image-view" alt="">
            </div>
            @endif

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image"
                    onchange="upload(event)">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id"
                    class="form-control @error('category_id') is-invalid @enderror">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @isset($post) @if($post->category_id == $category->id) selected
                        @endif @endisset>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if($tags->count())
            <div class="form-group">
                <label for="tags">Tags</label>
                <select multiple name="tags[]" id="tags"
                    class="form-control tag-selector @error('tags') is-invalid @enderror">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @isset($post) @if($post->hasTag($tag->id)) selected @endif
                        @endisset>{{ $tag->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <button type="submit" class="btn btn-success">
                {{ isset($post) ? 'Update' : 'Submit' }}
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"
    integrity="sha512-2RLMQRNr+D47nbLnsbEqtEmgKy67OSCpWJjJM394czt99xj3jJJJBQ43K7lJpfYAYtvekeyzqfZTx2mqoDh7vg=="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function upload(e){
            const image = document.querySelector('.image-view');
            image.src = URL.createObjectURL(e.target.files[0]);
            image.alt = e.target.files[0].name;
        }

        $('.tag-selector').select2();

        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        });

</script>
@endpush
