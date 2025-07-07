@extends('layout')

@section('title', $article->title)

@section('content')
<div class="bg-white shadow-sm rounded p-4">
    <h1 style="color:var(--primary);font-weight:700;">{{ $article->title }}</h1>
    @if($article->image_url || $article->image)
        <img src="{{ $article->image_url ? $article->image_url : asset('storage/' . $article->image) }}" alt="article image" class="img-fluid mb-3 rounded" style="max-height:320px;object-fit:cover;">
    @endif
    <p class="text-muted mb-2">By {{ $article->author ?? 'Unknown' }} | Category: {{ $article->category->name ?? 'Uncategorized' }} | Published on {{ $article->created_at ? $article->created_at->format('d M Y, H:i') : '' }}</p>
    <div class="mb-3" style="color:var(--primary);">
        {!! nl2br(e($article->content)) !!}
    </div>
    <a href="{{ route('articles.index') }}" class="btn btn-outline-primary">&larr; Back to Articles</a>
</div>
@endsection
