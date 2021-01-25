<?php

namespace App\Http\Controllers\API\Companies;

use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('companyBelongsToAuthenticatedUser')->only('update', 'show', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(['results' => Company::where('user_id', $request->user()->id)->latest()->paginate(20)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = Company::create([
            'name' => $request->name,
            'user_id' => $request->user()->id
        ]);

        if ($request->hasFile('image')) {
            $path = $request->image->store('public/companies/images');
            $company->update(['image' => $path]);
        }

        return response()->json(['company' => $company]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->json(['company' => $company->load('contacts')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company->update(['name' => $request->name]);

        if ($request->hasFile('image')) {
            $path = $request->image->store('public/companies/images');

            Storage::delete($company->image);

            $company->update(['image' => $path]);
        }

        return response()->json(['company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Contact::where('company_id', $company->id)->update(['company_id' => null]);

        $company->delete();

        return response()->json(['message' => 'Successfully deleted company!']);
    }
}
