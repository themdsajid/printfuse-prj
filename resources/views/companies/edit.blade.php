<x-app-layout>
<div class="container">
    <h2>Edit Company</h2>
    <form action="{{ route('companies.update', $company) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" value="{{ $company->address }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Industry</label>
            <input type="text" name="industry" value="{{ $company->industry }}" class="form-control">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
