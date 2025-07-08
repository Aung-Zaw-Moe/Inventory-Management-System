@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Brand Details</h5>
        <div>
            <a href="{{ route('brands.edit', $brand) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $brand->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $brand->description ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Number of Products</th>
                <td>{{ $brand->products_count }}</td>
            </tr>
        </table>

        <h5 class="mt-4">Products by this Brand</h5>
        @if($brand->products->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brand->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No products for this brand.</p>
        @endif
    </div>
</div>
@endsection