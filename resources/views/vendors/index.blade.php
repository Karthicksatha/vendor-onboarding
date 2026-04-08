<x-app-layout>

    <x-slot name="header">
        <h4>Vendor Applications</h4>
    </x-slot>

    <div class="mb-3">

        
    </div>


    <!-- FILTER -->

    <form method="GET" class="row g-2 mb-3">

        <div class="col-md-4">

            <input type="text" name="business_name" value="{{ request('business_name') }}" class="form-control"
                placeholder="Business Name">

        </div>

        <div class="col-md-3">

            <input type="text" name="account_number" value="{{ request('account_number') }}" class="form-control"
                placeholder="account number">

        </div>

        

        <div class="col-md-3">

            <select name="status" class="form-control">

                <option value="">All Status</option>

                <option value="draft">Draft</option>

                <option value="submitted">Submitted</option>

                <option value="approved">Approved</option>

                <option value="rejected">Rejected</option>

            </select>

        </div>

        <div class="col-md-2">

            <button class="btn btn-success w-100">
                Search
            </button>

        </div>

    </form>



    <!-- TABLE -->

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>
                <th>Business</th>
                <th>PAN</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            @forelse($vendors as $vendor)
                <tr>

                    <td>{{ $vendor->id }}</td>

                    <td>{{ $vendor->business_name }}</td>

                    <td>{{ $vendor->company_pan }}</td>

                    <td>{{ $vendor->contact_mobile }}</td>

                    <td>{{ ucfirst($vendor->status) }}</td>

                    <td>

                        <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-info btn-sm">
                            View
                        </a>

                        {{-- USER ACTIONS --}}
                        @if (auth()->id() == $vendor->user_id && in_array($vendor->status, ['draft', 'sent_back']))
                            <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('vendors.submit', $vendor->id) }}"
                                style="display:inline">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Submit
                                </button>
                            </form>
                        @endif


                        {{-- ADMIN ACTIONS --}}
                        @if (auth()->user()->role == 'admin' && $vendor->status == 'submitted')
                            <form method="POST" action="{{ route('admin.vendors.approve', $vendor->id) }}"
                                style="display:inline">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.vendors.reject', $vendor->id) }}"
                                style="display:inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.vendors.sendBack', $vendor->id) }}"
                                style="display:inline">
                                @csrf
                                <button class="btn btn-warning btn-sm">
                                    Send Back
                                </button>
                            </form>
                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">
                        No vendor applications found
                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

</x-app-layout>
