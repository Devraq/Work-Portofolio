@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>News Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Create Article</a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('articles.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search articles..." value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    @if (isset($query))
        <p>Search results for: <strong>{{ $query }}</strong></p>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Articles List -->
    <ul class="list-group">
        @forelse ($articles as $article)
            <li class="list-group-item">
                <h5>
                    <a href="{{ route('articles.show', $article) }}" class="text-dark">{{ $article->title }}</a>
                </h5>
                <img src="{{ $article->image_url ?? asset('storage/' . $article->image) }}" alt="article image" class="img-fluid">
                <p class="mb-1 text-muted"> by {{ $article->author }} | {{ $article->category->name }} | Published on {{ $article->created_at->format('d-m-Y H:i') }}</p>
                <p>{{ \Illuminate\Support\Str::limit($article->content, 200) }}
                    <a href="{{ route('articles.show', $article) }}" class="text-primary">Read More</a>
                </p>
            </li>
        @empty
            <li class="list-group-item text-center">No articles found.</li>
        @endforelse
    </ul>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
