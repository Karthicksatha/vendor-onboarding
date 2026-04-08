<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\VendorApplication;

class VendorApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $vendorId = $this->route('vendor');

        return [

            'business_name' => 'required|string|max:255',

            'business_type' => 'required',

            'contact_person_name' => 'required',

            'contact_email' => 'required|email',

            'contact_mobile' => [
                'required',
                'regex:/^[6-9]\d{9}$/',

                Rule::unique('vendor_applications')
                    ->ignore($vendorId)
                    ->where(function ($query) {

                        return $query->whereIn(
                            'status',
                            ['draft', 'submitted', 'sent_back']
                        );
                    })
            ],

            'company_pan' => [
                'required',
                'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',

                Rule::unique('vendor_applications')
                    ->ignore($vendorId)
                    ->where(function ($query) {

                        return $query->whereIn(
                            'status',
                            ['draft', 'submitted', 'sent_back']
                        );
                    })
            ],

            'gst_number' => [
                'nullable',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{3}$/',

                Rule::unique('vendor_applications')
                    ->ignore($vendorId)
                    ->where(function ($query) {

                        return $query->whereIn(
                            'status',
                            ['draft', 'submitted', 'sent_back']
                        );
                    })
            ],

            'address' => 'required',

            'city' => 'required',

            'state' => 'required',

            'pincode' => 'required|digits:6',

            'account_holder_name' => 'required',

            'account_number' => 'required',

            'ifsc_code' => [
                'required',
                'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/'
            ],
        ];
    }
}
