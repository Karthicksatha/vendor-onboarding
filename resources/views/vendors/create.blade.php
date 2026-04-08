<x-app-layout>

    <x-slot name="header">
        <h4>Create Vendor</h4>
    </x-slot>

    <div class="card p-4">

        <form method="POST" action="{{ route('vendors.store') }}">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Business Name</label>
                    <input type="text" name="business_name" value="{{ old('business_name') }}"
                        class="form-control @error('business_name') is-invalid @enderror">

                    @error('business_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Business Type</label>

                    <select name="business_type" class="form-control @error('business_type') is-invalid @enderror">

                        <option value="">Select Type</option>

                        <option value="Individual" {{ old('business_type') == 'Individual' ? 'selected' : '' }}>
                            Individual
                        </option>

                        <option value="Proprietorship" {{ old('business_type') == 'Proprietorship' ? 'selected' : '' }}>
                            Proprietorship
                        </option>

                        <option value="Partnership" {{ old('business_type') == 'Partnership' ? 'selected' : '' }}>
                            Partnership
                        </option>

                        <option value="Pvt Ltd" {{ old('business_type') == 'Pvt Ltd' ? 'selected' : '' }}>
                            Pvt Ltd
                        </option>

                        <option value="LLP" {{ old('business_type') == 'LLP' ? 'selected' : '' }}>
                            LLP
                        </option>

                    </select>

                    @error('business_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Contact Person</label>
                    <input type="text" name="contact_person_name" value="{{ old('contact_person_name') }}"
                        class="form-control @error('contact_person_name') is-invalid @enderror">

                    @error('contact_person_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email') }}"
                        class="form-control @error('contact_email') is-invalid @enderror">

                    @error('contact_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Mobile</label>
                    <input type="text" name="contact_mobile" value="{{ old('contact_mobile') }}"
                        class="form-control @error('contact_mobile') is-invalid @enderror">

                    @error('contact_mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>PAN</label>
                    <input type="text" name="company_pan" value="{{ old('company_pan') }}"
                        class="form-control @error('company_pan') is-invalid @enderror">

                    @error('company_pan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>GST</label>
                    <input type="text" name="gst_number" value="{{ old('gst_number') }}"
                        class="form-control @error('gst_number') is-invalid @enderror">

                    @error('gst_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>City</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="form-control @error('city') is-invalid @enderror">

                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>State</label>
                    <input type="text" name="state" value="{{ old('state') }}"
                        class="form-control @error('state') is-invalid @enderror">

                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Pincode</label>
                    <input type="text" name="pincode" value="{{ old('pincode') }}"
                        class="form-control @error('pincode') is-invalid @enderror">

                    @error('pincode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Account Holder</label>
                    <input type="text" name="account_holder_name" value="{{ old('account_holder_name') }}"
                        class="form-control @error('account_holder_name') is-invalid @enderror">

                    @error('account_holder_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>Account Number</label>
                    <input type="text" name="account_number" value="{{ old('account_number') }}"
                        class="form-control @error('account_number') is-invalid @enderror">

                    @error('account_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6 mb-3">
                    <label>IFSC</label>
                    <input type="text" name="ifsc_code" value="{{ old('ifsc_code') }}"
                        class="form-control @error('ifsc_code') is-invalid @enderror">

                    @error('ifsc_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>

                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button class="btn btn-primary">
                Save Draft
            </button>

        </form>

    </div>

</x-app-layout>
