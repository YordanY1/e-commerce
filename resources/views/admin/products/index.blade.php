@extends('layouts.admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin | Products</h1>
            <!-- Button to trigger modal for adding new product -->
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>
            @include('components.create-products-admin-modal')
            <!-- Products Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Manufacturer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->manufacturer->name }}</td>
                            <td>
                                <!-- Placeholder for edit button -->
                                <button class="btn btn-primary btn-sm" onclick="editProduct({{ $product->id }})">Edit</button>
                                <!-- Placeholder for delete button -->
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct({{ $product->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>
</div>
@endsection
