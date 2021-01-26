<?php

namespace App\Http\Controllers\API\Companies\Tags;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\CompanyTagMap;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyTagMapRequest;

class CompanyTagMapController extends Controller
{
    public function __construct()
    {
        $this->middleware('companyBelongsToAuthenticatedUser')->only('store', 'update', 'show', 'delete');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company, Tag $tag)
    {
        $map = CompanyTagMap::updateOrCreate(['company_id' => $company->id, 'tag_id' => $tag->id]);

        return response()->json(['map' => $map->load('company', 'tag')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyTagMap  $companyTagMap
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyTagMap $companyTagMap)
    {
        return response()->json(['company_tag_map' => $company_tag_map->load('company', 'tag')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyTagMap  $companyTagMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyTagMap $companyTagMap)
    {
        $companyTagMap->update($request->only('company_id', 'tag_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyTagMap  $companyTagMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyTagMap $companyTagMap)
    {
        //
    }
}
