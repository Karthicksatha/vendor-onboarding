<x-app-layout>

    <x-slot name="header">
        <h4>Vendor Application Report</h4>
    </x-slot>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>Status</th>
                <th>Total Applications</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($report as $row)
                <tr>

                    <td>{{ ucfirst($row->status) }}</td>

                    <td>{{ $row->total }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>

</x-app-layout>
