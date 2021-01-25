<?php

namespace App\Http\Controllers\API\Tags;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\CompanyTagMap;
use App\Models\ContactTagMap;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\StoreTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->only('name'));

        return response()->json(['tag' => $tag]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return response()->json(['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($request->only('name'));

        return response()->json(['tag' => $tag]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        CompanyTagMap::where('tag_id', $tag->id)->delete();
        ContactTagMap::where('tag_id', $tag->id)->delete();
        // Tags should actually be kept but only have their mapped relationships removed
        // $tag->delete();

        return response()->json(['message' => 'Successfully deleted tag!']);
    }
}
