@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>News Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-create-article">Create Article</a>
    </div>

    <!-- Search Form -->
    <form action="{{ route('articles.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search articles..." value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary btn-search">Search</button>
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
                    <a href="{{ route('articles.show', $article->id) }}" class="text-dark">{{ $article->title }}</a>
                </h5>
                <img src="{{ $article->image ? asset('storage/' . $article->image) : $article->image_url}}" alt="article image" class="img-fluid">
                <p class="mb-1 text-muted">
                    by {{ $article->author }} | {{ $article->category->name }} | Published on {{ $article->created_at->format('d-m-Y H:i') }}
                </p>
                <p>
                    {{ \Illuminate\Support\Str::limit($article->content, 200) }}
                    <a href="{{ route('articles.show', $article->id) }}" class="text-primary">Read More</a>
                </p>
                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-edit-custom">Edit</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete-custom">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center">No articles found.</li>
        @endforelse
    </ul>

    <!-- Pagination -->
    @if ($articles->hasPages())
        <nav class="mt-4 d-flex justify-content-center" aria-label="Page navigation">
            <ul class="pagination pagination-lg shadow-sm rounded-pill">
                {{-- Previous Page Link --}}
                @if ($articles->onFirstPage())
                    <li class="page-item disabled"><span class="page-link rounded-pill">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link rounded-pill" href="{{ $articles->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($articles->links()->elements[0] as $page => $url)
                    @if ($page == $articles->currentPage())
                        <li class="page-item active"><span class="page-link rounded-pill">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link rounded-pill" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($articles->hasMorePages())
                    <li class="page-item"><a class="page-link rounded-pill" href="{{ $articles->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link rounded-pill">&raquo;</span></li>
                @endif
            </ul>
        </nav>
    @endif
@endsection
