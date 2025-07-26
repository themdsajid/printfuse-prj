<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            My Companies
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert"
            style="font-size: 16px; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                style="float: right;"></button>
        </div>

        <script>
            setTimeout(function() {
                let alertBox = document.getElementById('success-alert');
                if (alertBox) {
                    alertBox.style.transition = 'opacity 0.5s ease';
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500);
                }
            }, 3000); // 3 seconds
        </script>
    @endif


    <div class="container mt-3">
        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add New Company</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Industry</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->companies as $company)
                    <tr>
                        <td>{{ $loop->iteration }} </td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->industry }}</td>
                        <td>
                            @if (auth()->user()->active_company_id === $company->id)
                                <span class="badge bg-success">Active</span>
                            @else
                                <form method="POST" action="{{ route('companies.switch', $company) }}"
                                    style="display:inline;">
                                    @csrf
                                    <button class="btn btn-sm btn-info">Switch</button>
                                </form>
                            @endif
                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="{{ route('companies.destroy', $company) }}"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this company?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
