<x-app-layout>

    <x-slot name="header">
        <h4>Vendor Status History</h4>
    </x-slot>

    <div class="card p-4">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>From Status</th>
                    <th>To Status</th>
                    <th>Action By</th>
                    <th>Remarks</th>
                    <th>Date</th>
                </tr>

            </thead>

            <tbody>

                @forelse($logs as $log)
                    <tr>

                        <td>{{ $log->from_status }}</td>

                        <td>{{ $log->to_status }}</td>

                        <td>{{ $log->user->name }}</td>

                        <td>{{ $log->remarks }}</td>

                        <td>{{ $log->created_at }}</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No status history available
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</x-app-layout>
