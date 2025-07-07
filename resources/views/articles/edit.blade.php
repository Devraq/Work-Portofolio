@extends('layout')

@section('content')
    <div class="container mt-5">
        <h1>Edit Article</h1>

        @if (!isset($article) || !isset($categories) || $categories->isEmpty())
            <div class="alert alert-danger">
                Unable to load article or categories. Please try again later.
            </div>
        @else
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('articles.update', $article->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $article->author ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (isset($article->category_id) && $article->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                        @if (!isset($article->category_id) || !$categories->contains('id', $article->category_id))
                            <option value="" selected disabled>-- Select Category --</option>
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $article->content ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if (!empty($article->image) || !empty($article->image_url))
                        <img src="{{ $article->image_url ?? ($article->image ? asset('storage/' . $article->image) : asset('images/default-article.png')) }}" alt="Current image" class="img-fluid mt-2" style="max-width: 200px;">
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        @endif
    </div>
@endsection