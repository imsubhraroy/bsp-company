<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Branch;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Service;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

        $companies = Company::where('user_id', Auth::user()->id)
            ->with(['services', 'branches'])
            ->latest()
            ->paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();

        return view('companies.create', compact('countries', 'services', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^[0-9+\-\(\)\s]+$/', 'max:20'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['exists:services,id'],
            'branches' => ['required', 'array', 'min:1'],
            'branches.*' => ['exists:branches,id'],
        ], [
            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, jpg, png, gif.',
            'logo.max' => 'The logo may not be greater than 2MB.',
            'name.required' => 'Please enter the company name.',
            'email.required' => 'Please enter the company email.',
            'email.email' => 'Please enter a valid email address.',
            'mobile.required' => 'Please enter the mobile number.',
            'mobile.regex' => 'Please enter a valid mobile number.',
            'country_id.required' => 'Please select a country.',
            'state_id.required' => 'Please select a state.',
            'city_id.required' => 'Please select a city.',
            'services.required' => 'Please select at least one service.',
            'services.min' => 'Please select at least one service.',
            'branches.required' => 'Please select at least one branch.',
            'branches.min' => 'Please select at least one branch.',
        ]);
        $data['user_id'] = Auth::user()->id;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company = Company::create($data);

        // Sync relationships
        $company->services()->sync($request->input('services', []));
        $company->branches()->sync($request->input('branches', []));

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {

        $company->load(['services', 'branches', 'country', 'state', 'city']);

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {

        $countries = Country::orderBy('name')->get();
        $states = State::where('country_id', $company->country_id)->orderBy('name')->get();
        $cities = City::where('state_id', $company->state_id)->orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        $branches = Branch::orderBy('name')->get();

        $selectedServices = $company->services->pluck('id')->toArray();
        $selectedBranches = $company->branches->pluck('id')->toArray();

        return view('companies.edit', compact(
            'company',
            'countries',
            'states',
            'cities',
            'services',
            'branches',
            'selectedServices',
            'selectedBranches'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {

        $data = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'regex:/^[0-9+\-\(\)\s]+$/', 'max:20'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['exists:services,id'],
            'branches' => ['required', 'array', 'min:1'],
            'branches.*' => ['exists:branches,id'],
        ], [
            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, jpg, png, gif.',
            'logo.max' => 'The logo may not be greater than 2MB.',
            'name.required' => 'Please enter the company name.',
            'email.required' => 'Please enter the company email.',
            'email.email' => 'Please enter a valid email address.',
            'mobile.required' => 'Please enter the mobile number.',
            'mobile.regex' => 'Please enter a valid mobile number.',
            'country_id.required' => 'Please select a country.',
            'state_id.required' => 'Please select a state.',
            'city_id.required' => 'Please select a city.',
            'services.required' => 'Please select at least one service.',
            'services.min' => 'Please select at least one service.',
            'branches.required' => 'Please select at least one branch.',
            'branches.min' => 'Please select at least one branch.',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        // Sync relationships
        $company->services()->sync($request->input('services', []));
        $company->branches()->sync($request->input('branches', []));

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {

        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
