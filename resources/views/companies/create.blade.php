<x-app-layout>
    <div class="container">
        <h2>Add New Company</h2>
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="mb-3">
                <label>Industry</label>
                <input type="text" name="industry" class="form-control">
            </div>
            <button class="btn btn-success">Create</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>
