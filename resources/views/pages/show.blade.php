@extends('layouts.index')

@section('content')
<div class="jumbotron jumbotron-fluid mt-n4">
    <div class="container text-center py-4">
        <h1 class="display-4">Detail Posts</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <img src="{{ $post->photo }}" width="300" alt="{{ $post->title }}">
    <h1 class="mt-3">{{ $post->title }}</h1>
    <p>Posted by : {{ $post->user->name }} | {{ $post->created_at->format('d F Y H:i') }}</p>
    <hr>
    <span class="badge badge-success">Category : {{ $post->category->name }}</span>
    @foreach ($post->tags as $tag)
    <span class="badge badge-danger">{{ $tag->name }}</span>
    @endforeach
    <p>Description: {{ $post->description }}</p>
    <p>{!! $post->content !!}</p>

    <div id="disqus_thread"></div>
</div>
@endsection

@push('scripts')
<script>
    /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "{{ $post->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };

        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://cms-app-1.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
        Disqus.</a></noscript>
@endpush
