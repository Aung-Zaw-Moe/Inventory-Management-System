@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Brand</div>
    <div class="card-body">
        <form action="{{ route('brands.update', $brand) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $brand->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Brand</button>
        </form>
    </div>
</div>
@endsection