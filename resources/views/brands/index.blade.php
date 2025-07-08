@extends('layouts.app')

@section('content')
<div class="card">
     <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Brand List</h5>
        <div>
            <a href="{{ route('brands.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Brand
            </a>
            <a href="{{ route('brands.export') }}" class="btn btn-success" id="exportBrandsBtn">
                <i class="fas fa-file-excel"></i> Export
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-secondary table-bordered border-secondary">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Product Count</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->description ?? 'N/A' }}</td>
                    <td>{{ $brand->products_count }}</td>
                    <td >
                        <div class="d-flex gap-2">
                            <a href="{{ route('brands.show', $brand) }}" class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('brands.edit', $brand) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Add pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $brands->links() }}
        </div>
    </div>
</div>
@push('scripts')
<script>
document.getElementById('exportBrandsBtn').addEventListener('click', function(e) {
    e.preventDefault();
    // Show loading indicator
    const btn = this;
    const originalHtml = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
    
    // Trigger download
    window.location.href = this.href;
    
    // Reset button after 3 seconds
    setTimeout(() => {
        btn.innerHTML = originalHtml;
    }, 3000);
});
</script>
@endpush
@endsection