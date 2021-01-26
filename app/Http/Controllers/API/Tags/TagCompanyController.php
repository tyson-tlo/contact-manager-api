<?php

namespace App\Http\Controllers\API\Tags;

use App\Models\Tag;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyTagMap;
use App\Http\Controllers\Controller;

class TagCompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $company = \App\Models\Company::where('user_id', $request->user()->id)->where('id', $request->company)->first();
            if ($company) {
                return $next($request);
            }

            return response("Not Authorized.", 403);
        })->only('store', 'update', 'delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag)
    {
        $map = CompanyTagMap::create([
            'tag_id' => $tag->id,
            'company_id' => $request->company
        ]);

        return response()->json(['map' => $map->load('company', 'tag')]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
