@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')
    <div class="mb-6">
        <a href="{{ route('companies.index') }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Companies
        </a>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-6">Edit Company</h3>

            <form method="POST" action="{{ route('companies.update', $company) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <!-- Company Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Company Logo</label>
                        <div class="mt-1 flex items-center space-x-4">
                            @if ($company->logo)
                                <img src="{{ $company->logo_url }}" alt="Current logo"
                                    class="h-20 w-20 rounded-lg object-cover">
                            @endif
                            <div id="logoPreview" class="{{ $company->logo ? '' : 'hidden' }}">
                                <img src="" alt="Logo preview" class="h-20 w-20 rounded-lg object-cover">
                            </div>
                            <input type="file" name="logo" id="logo" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Company Name *</label>
                        <input type="text" name="name" id="name" required
                            value="{{ old('name', $company->name) }}"
                            class="mt-1 block w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email & Mobile -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" required
                                value="{{ old('email', $company->email) }}"
                                class="mt-1 block w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile *</label>
                            <input type="text" name="mobile" id="mobile" required
                                value="{{ old('mobile', $company->mobile) }}"
                                class="mt-1 block w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('mobile') border-red-500 @enderror">
                            @error('mobile')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Country, State, City -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="country_id" class="block text-sm font-medium text-gray-700">Country *</label>
                            <select name="country_id" id="country_id" required
                                class="mt-1 block w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('country_id') border-red-500 @enderror">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id', $company->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state_id" class="block text-sm font-medium text-gray-700">State *</label>
                            <select name="state_id" id="state_id" required
                                class="mt-1 block w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('state_id') border-red-500 @enderror">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('state_id', $company->state_id) == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="city_id" class="block text-sm font-medium text-gray-700">City *</label>
                            <select name="city_id" id="city_id" required
                                class="mt-1 block w-full rounded-md px-3 py-2 border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('city_id') border-red-500 @enderror">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"
                                        {{ old('city_id', $company->city_id) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Services -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Services * (Select multiple)</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($services as $service)
                                <div class="flex items-center">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                        id="service_{{ $service->id }}"
                                        {{ in_array($service->id, old('services', $selectedServices)) ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="service_{{ $service->id }}" class="ml-2 text-sm text-gray-700">
                                        {{ $service->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('services')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Branches -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Branches * (Select multiple)</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach ($branches as $branch)
                                <div class="flex items-center">
                                    <input type="checkbox" name="branches[]" value="{{ $branch->id }}"
                                        id="branch_{{ $branch->id }}"
                                        {{ in_array($branch->id, old('branches', $selectedBranches)) ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="branch_{{ $branch->id }}" class="ml-2 text-sm text-gray-700">
                                        {{ $branch->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('branches')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('companies.index') }}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700">
                            Update Company
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Logo Preview
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('logoPreview');
                    preview.querySelector('img').src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Country Change
        document.getElementById('country_id').addEventListener('change', function() {
            const countryId = this.value;
            const stateSelect = document.getElementById('state_id');
            const citySelect = document.getElementById('city_id');

            stateSelect.innerHTML = '<option value="">Select State</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';

            if (countryId) {
                fetch(`/api/states/${countryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(state => {
                            const option = document.createElement('option');
                            option.value = state.id;
                            option.textContent = state.name;
                            stateSelect.appendChild(option);
                        });
                    });
            }
        });

        // State Change
        document.getElementById('state_id').addEventListener('change', function() {
            const stateId = this.value;
            const citySelect = document.getElementById('city_id');

            citySelect.innerHTML = '<option value="">Select City</option>';

            if (stateId) {
                fetch(`/api/cities/${stateId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            citySelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection
