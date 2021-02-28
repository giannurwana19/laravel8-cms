<div class="col-md-3">
    <div class="row mb-4">
        <div class="col-md">
            <ul class="list-group">
                <li class="list-group-item active">Categories</li>
                <li class="list-group-item list-group-item-action">
                    @foreach ($categories as $category)
                    <a href="{{ route('blogs.category', $category) }}" class="badge badge-success">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <ul class="list-group">
                <li class="list-group-item active">Tags</li>
                <li class="list-group-item">
                    @foreach ($tags as $tag)
                    <a href="{{ route('blogs.tag', $tag) }}" class="badge badge-danger">
                        {{ $tag->name }}
                    </a>
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
</div>
