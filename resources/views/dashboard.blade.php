<x-app-layout>

    <x-slot name="header">
        <h4>Dashboard</h4>
    </x-slot>

    <div class="container mt-4">

        <div class="row">

            <!-- Vendor Applications -->

            <div class="col-md-4 mb-3">

                <div class="card text-center p-4">

                    <h5>Vendor Applications</h5>

                    <p>View and manage vendor onboarding applications</p>

                    <a href="{{ route('vendors.index') }}" class="btn btn-primary">
                        Open Vendors
                    </a>

                </div>

            </div>


            <!-- Reports -->

            @if (auth()->user()->role == 'admin')
                <div class="col-md-4 mb-3">

                    <div class="card text-center p-4">

                        <h5>Reports</h5>

                        <p>View application statistics by status</p>

                        <a href="{{ route('reports.index') }}" class="btn btn-success">
                            Open Reports
                        </a>

                    </div>

                </div>
            @endif


            <!-- Create Vendor (Users only) -->

            @if (auth()->user()->role == 'user')
                <div class="col-md-4 mb-3">

                    <div class="card text-center p-4">

                        <h5>Create Vendor</h5>

                        <p>Create a new vendor application</p>

                        <a href="{{ route('vendors.create') }}" class="btn btn-warning">
                            Create Vendor
                        </a>

                    </div>

                </div>
            @endif


        </div>

    </div>

</x-app-layout>
