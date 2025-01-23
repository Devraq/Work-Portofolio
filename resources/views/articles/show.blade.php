@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1>{{ $article->title }}</h1>
            <img src="{{$article->image ? asset('storage/' . $article->image) : $article->image_url}}" class="img-fluid">
            <p class="text-muted">By {{ $article->author }} | Category: {{ $article->category->name }} | Published on {{ $article->created_at->format('d M Y, H:i') }}</p>
            <hr>
            <p>{{ $article->content }}</p>
        </div>
    </div>
    <div class="mt-3 d-flex gap-2">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to Articles</a>
        <a href="{{ route('articles.edit', $article) }}" class="btn btn-primary">Edit Article</a>
        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">
                Delete Article
            </button>
        </form>
    </div>
</div>
@endsection
