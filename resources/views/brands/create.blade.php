@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Add New Brand</div>
    <div class="card-body">
        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Brand</button>
        </form>
    </div>
</div>
@endsection