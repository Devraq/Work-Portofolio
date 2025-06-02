@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1>{{ $article->title }}</h1>
            <img src="{{$article->image_url ?? asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid">
            <p class="text-muted">By {{ $article->author }} | Category: {{ $article->category->name }} | Published on {{ $article->created_at->format('d M Y, H:i') }}</p>
            <hr>
            <p>{{ $article->content }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to Articles</a>
    </div>
</div>
@endsection
