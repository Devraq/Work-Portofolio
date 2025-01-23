<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query()->with('category');
        $selectedCategory = null;
        if ($request->filled('category')) {
            $selectedCategory = Category::find($request->category);
            $query->where('category_id', $request->category);
        }
        $articles = $query->latest()->paginate(10);
        $categories = Category::all();
        return view('articles.index', compact('articles','categories','selectedCategory'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'nullable|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author ?? auth()->user()->name,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
    public function edit(Article $article)
{
    $categories = Category::all();
    return view('articles.edit', compact('article', 'categories'));
}

public function update(Request $request, Article $article)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'author' => 'nullable|string|max:100',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $imagePath = $request->file('image')->store('articles', 'public');
        $article->image = $imagePath;
    }

    $article->update([
        'title' => $request->title,
        'content' => $request->content,
        'author' => $request->author,
        'category_id' => $request->category_id,
    ]);
    if (isset($imagePath)) {
        $article->image = $imagePath;
        $article->save();
    }
    return redirect()->route('articles.show', $article)->with('success', 'Article updated successfully.');
}

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search articles by title or content
        $articles = Article::where('title', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('articles.index', compact('articles', 'query'));
    }
}
