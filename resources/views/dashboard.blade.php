@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-lg border-0" style="background-color: #f8f9fa;">
            <div class="card-header bg-dark text-white border-0">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>System Overview
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border-start border-primary border-4 shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Products</h6>
                                        <h4 class="mb-0">{{ $totalProducts }}</h4>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="fas fa-box text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-start border-success border-4 shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Stock Value</h6>
                                        <h4 class="mb-0">${{ number_format($totalStockValue, 2) }}</h4>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="fas fa-dollar-sign text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg border-0" style="background-color: #f8f9fa;">
            <div class="card-header bg-dark text-white border-0">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg shadow">
                        <i class="fas fa-plus me-2"></i>Add New Product
                    </a>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('categories.create') }}" class="btn btn-outline-dark w-100 shadow-sm">
                                <i class="fas fa-tag me-2"></i>Add Category
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('brands.create') }}" class="btn btn-outline-info w-100 shadow-sm">
                                <i class="fas fa-copyright me-2"></i>Add Brand
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 h-100" style="background-color: #f8f9fa;">
            <div class="card-header bg-dark text-white border-0">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>Products by Category
                </h5>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg border-0 h-100" style="background-color: #f8f9fa;">
            <div class="card-header bg-dark text-white border-0">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>Products by Brand
                </h5>
            </div>
            <div class="card-body">
                <canvas id="brandChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-lg border-0" style="background-color: #f8f9fa;">
            <div class="card-header bg-dark text-white border-0">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Low Stock Products
                </h5>
            </div>
            <div class="card-body">
                @if($lowStockProducts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockProducts as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark shadow-sm">{{ $product->quantity }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-success mb-0 shadow-sm">
                        <i class="fas fa-check-circle me-2"></i>All products have sufficient stock!
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg border-0" style="background-color: #f8f9fa;">
            <div class="card-header bg-dark text-white border-0">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2 text-info"></i>Recently Added Products
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProducts as $product)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Category Pie Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($categoriesData->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($categoriesData->pluck('products_count')) !!},
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                    '#5a5c69', '#858796', '#3a3b45', '#f8f9fc', '#5a5c69'
                ],
                hoverBackgroundColor: [
                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617',
                    '#42444e', '#6b6d7d', '#2a2b33', '#dde2f1', '#42444e'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.formattedValue || '';
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    },
                    bodyFont: {
                        weight: 'bold',
                        size: 14
                    }
                }
            }
        }
    });

    // Brand Pie Chart
    const brandCtx = document.getElementById('brandChart').getContext('2d');
    const brandChart = new Chart(brandCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($brandsData->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($brandsData->pluck('products_count')) !!},
                backgroundColor: [
                    '#6610f2', '#6f42c1', '#e83e8c', '#fd7e14', '#20c997',
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'
                ],
                hoverBackgroundColor: [
                    '#520dc2', '#5a32a8', '#c2186b', '#d56a0b', '#17a673',
                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.formattedValue || '';
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    },
                    bodyFont: {
                        weight: 'bold',
                        size: 14
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection