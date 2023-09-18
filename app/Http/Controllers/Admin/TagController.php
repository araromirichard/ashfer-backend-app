<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
   
     */
    public function index()
    {
        return Inertia::render('Tags/Index', [
            'tags' => TagResource::collection(Tag::latest()->simplePaginate(10))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
 
     */
    public function create()
    {
        return Inertia::render('Tags/Create', [
            'edit' => false,
            'tag' => (object)[]
        ]);
    }

    /**
     * Store a newly created resource in storage.

     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('tags')],
            'description' => ['nullable', 'string'],
        ]);
        
        

        Tag::create($data);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
    
     
     */
    public function edit(Tag $tag)
    {
        return Inertia::render('Tags/Create', [
            'edit' => true,
            'tag' => new TagResource($tag)
        ]);
    }


    /**
     * Update the specified resource in storage.
    
     */
    public function update(Request $request, Tag $tag)

    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('tags')->ignore($tag->id)],
            'description' => ['nullable', 'string'],
        ]);

        $tag->update($data);
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
   
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
