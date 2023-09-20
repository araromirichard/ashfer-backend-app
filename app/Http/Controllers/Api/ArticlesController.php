<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        // $limit = $request->get('limit', 6);

        $articles = Article::with(['category:id,name', 'tags:id,name'])->latest()->simplePaginate($request->get('limit', 6));

        return ArticleResource::collection($articles);
    }


    public function show(Request $request, Article $article)
    {
        // Load the article with its associated category
        $article->load(['category:id,name', 'tags:id,name']);

        // Get the category ID of the current article
        $articleCategoryId = $article->category->id;

        // Find other articles with the same category as the current article
        $relatedArticles = $this->getRelatedArticles($articleCategoryId);

        // Return the current article and the related articles as JSON
        return response()->json([
            'current_article' => new ArticleResource($article),
            'related_articles' => $relatedArticles,
        ]);
    }


    protected function getRelatedArticles($articleCategoryId)
    {
        // Retrieve related articles using the category relationship
        return Article::where('category_id', $articleCategoryId)
            ->latest()
            ->take(5)
            ->get();
    }
}
