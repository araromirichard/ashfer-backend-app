<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Article; 
use App\Models\Category; 
use App\Models\Tag; 

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the counts from the database
        $articleCount = Article::count();
        $categoryCount = Category::count();
        $tagCount = Tag::count();
        
        // Pass the counts to the 'Dashboard' view
        return Inertia::render('Dashboard', [
            'articleCount' => $articleCount,
            'categoryCount' => $categoryCount,
            'tagCount' => $tagCount,
        ]);
    }
}
