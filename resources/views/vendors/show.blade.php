<x-app-layout>

    <x-slot name="header">
        <h4>Vendor Application Details</h4>
    </x-slot>

    <div class="card p-4">

        <table class="table table-bordered">

            <tr class="table-secondary">
                <th colspan="2">Business Information</th>
            </tr>

            <tr>
                <th>Business Name</th>
                <td>{{ $vendor->business_name }}</td>
            </tr>

            <tr>
                <th>Business Type</th>
                <td>{{ $vendor->business_type }}</td>
            </tr>


            <tr class="table-secondary">
                <th colspan="2">Contact Information</th>
            </tr>

            <tr>
                <th>Contact Person</th>
                <td>{{ $vendor->contact_person_name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $vendor->contact_email }}</td>
            </tr>

            <tr>
                <th>Mobile</th>
                <td>{{ $vendor->contact_mobile }}</td>
            </tr>


            <tr class="table-secondary">
                <th colspan="2">Identity Details</th>
            </tr>

            <tr>
                <th>Company PAN</th>
                <td>{{ $vendor->company_pan }}</td>
            </tr>

            <tr>
                <th>GST Number</th>
                <td>{{ $vendor->gst_number }}</td>
            </tr>


            <tr class="table-secondary">
                <th colspan="2">Address</th>
            </tr>

            <tr>
                <th>Address</th>
                <td>{{ $vendor->address }}</td>
            </tr>

            <tr>
                <th>City</th>
                <td>{{ $vendor->city }}</td>
            </tr>

            <tr>
                <th>State</th>
                <td>{{ $vendor->state }}</td>
            </tr>

            <tr>
                <th>Pincode</th>
                <td>{{ $vendor->pincode }}</td>
            </tr>


            <tr class="table-secondary">
                <th colspan="2">Bank Details</th>
            </tr>

            <tr>
                <th>Account Holder</th>
                <td>{{ $vendor->account_holder_name }}</td>
            </tr>

            <tr>
                <th>Account Number</th>
                <td>{{ $vendor->account_number }}</td>
            </tr>

            <tr>
                <th>IFSC Code</th>
                <td>{{ $vendor->ifsc_code }}</td>
            </tr>


            <tr class="table-secondary">
                <th colspan="2">Application Status</th>
            </tr>

            <tr>
                <th>Status</th>
                <td>{{ ucfirst($vendor->status) }}</td>
            </tr>

        </table>

    </div>


    <div class="mt-3">

        <a href="{{ route('vendors.history', $vendor->id) }}" class="btn btn-secondary">
            View Status History
        </a>

    </div>


    {{-- ADMIN REVIEW ACTIONS --}}

    @if (auth()->user()->role == 'admin' && $vendor->status == 'submitted')
        <div class="mt-4">

            <form method="POST" action="{{ route('admin.vendors.approve', $vendor->id) }}" style="display:inline">
                @csrf
                <button class="btn btn-success">
                    Approve
                </button>
            </form>


            <form method="POST" action="{{ route('admin.vendors.reject', $vendor->id) }}" style="display:inline">
                @csrf

                <input type="text" name="remarks" placeholder="Reason for rejection" class="form-control mb-2">

                <button class="btn btn-danger">
                    Reject
                </button>

            </form>


            <form method="POST" action="{{ route('admin.vendors.sendBack', $vendor->id) }}" style="display:inline">
                @csrf

                <input type="text" name="remarks" placeholder="Reason for send back" class="form-control mb-2">

                <button class="btn btn-warning">
                    Send Back
                </button>

            </form>

        </div>
    @endif


</x-app-layout>
