@extends('layouts.admin.products.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin | Products</h1>
            <!-- Button to trigger modal for adding new product -->
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>

            <x-create-products-admin-modal :manufacturers="$manufacturers" :categories="$categories"/>


            <!-- Products Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Slug</th>
                            <th>Manufacturer</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->manufacturer->name }}</td>
                            <td>{{ $product->attributes->description }}</td>
                            <td>
                                @if(is_array($product->attributes->categories))
                                    @foreach ($product->attributes->categories as $category_id)
                                        @if ($category = $categories->firstWhere('id', $category_id))
                                            <span class="badge bg-secondary">{{ $category->name }}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if ($product->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
                                @endif
                            </td>
                            <td>{{ $product->price->price }}</td> <!-- Displaying the price -->
                            <td>
                                <!-- Actions -->
                                <button class="btn btn-primary btn-sm" onclick="editProduct({{ $product->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteProduct({{ $product->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        @include('components.edit-products-admin-modal')
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection
