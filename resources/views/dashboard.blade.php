@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white rounded-top">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>Monthly Product Growth
                </h5>
            </div>
            <div class="card-body">
                <canvas id="lineChart" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-success text-white rounded-top">
                <h5 class="mb-0">
                    <i class="fas fa-tachometer-alt me-2"></i>System Overview
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card border-start border-primary border-4 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Products</h6>
                                        <h3 class="mb-0">{{ $totalProducts }}</h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="fas fa-box text-primary fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-start border-success border-4 shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-muted mb-1">Total Stock Value</h6>
                                        <h3 class="mb-0">${{ number_format($totalStockValue, 2) }}</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="fas fa-dollar-sign text-success fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="fas fa-plus me-2"></i>Add New Product
                        </a>
                        <div class="row g-2">
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
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3 h-100">
            <div class="card-header bg-warning text-dark rounded-top">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Top Categories (Product Count)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3 h-100">
            <div class="card-header bg-info text-white rounded-top">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Top Brands (Product Count)
                </h5>
            </div>
            <div class="card-body">
                <canvas id="brandChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-danger text-white rounded-top">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>Low Stock Products (Under 10)
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
                                    <th>Action</th>
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
                                        <span class="badge bg-danger text-white shadow-sm">{{ $product->quantity }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
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
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-secondary text-white rounded-top">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>Recently Added Products
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
                                <th>Added</th>
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
                                <td>{{ $product->created_at->diffForHumans() }}</td>
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
    // Line Chart - Monthly Product Growth
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Products Added',
                data: {!! json_encode($productCounts) !!},
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                borderColor: 'rgba(13, 110, 253, 1)',
                pointBackgroundColor: 'rgba(13, 110, 253, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw}`;
                        }
                    },
                    bodyFont: {
                        weight: 'bold',
                        size: 14
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        },
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    });

    // Category Vertical Bar Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const categoryChart = new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categoriesData->pluck('name')) !!},
            datasets: [{
                label: 'Number of Products',
                data: {!! json_encode($categoriesData->pluck('products_count')) !!},
                backgroundColor: [
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.raw} products`;
                        }
                    },
                    bodyFont: {
                        weight: 'bold',
                        size: 14
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        },
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    });

    // Brand Vertical Bar Chart
    const brandCtx = document.getElementById('brandChart').getContext('2d');
    const brandChart = new Chart(brandCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($brandsData->pluck('name')) !!},
            datasets: [{
                label: 'Number of Products',
                data: {!! json_encode($brandsData->pluck('products_count')) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.raw} products`;
                        }
                    },
                    bodyFont: {
                        weight: 'bold',
                        size: 14
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#333',
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        font: {
                            weight: 'bold'
                        },
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection