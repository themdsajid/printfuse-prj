<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'industry' => 'nullable',
        ]);

        $company = Auth::user()->companies()->create($request->all());

        // Optionally set as active if first company
        if (!Auth::user()->active_company_id) {
            Auth::user()->update(['active_company_id' => $company->id]);
        }

        return redirect()->route('dashboard')->with('success', 'Company Added Successfully');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $this->authorizeCompany($company);
        $company->update($request->only(['name', 'address', 'industry']));
        return redirect()->route('dashboard')->with('success', 'Company Updated Successfully');
    }

    public function destroy(Company $company)
    {
        $this->authorizeCompany($company);
        $company->delete();
        return redirect()->route('dashboard')->with('success', 'Company Deleted Successfully');
    }

    public function switch(Company $company)
    {
        $this->authorizeCompany($company);
        Auth::user()->update(['active_company_id' => $company->id]);
        return redirect()->back();
    }

    protected function authorizeCompany(Company $company)
    {
        if ($company->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
