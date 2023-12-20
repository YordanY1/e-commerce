@extends('layouts.admin.categories.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin | Categories</h1>

            <!-- Add New Category Button -->
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                Add New Category
            </button>

            <!-- Include Create Category Modal Component -->
            @include('components.create-categories-admin-modal')

            <!-- Category Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->code }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary btn-sm" onclick="editCategory({{ $category->id }})">Edit</button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteCategory({{ $category->id }})">Delete</button>
                        </td>
                            <!-- Include Edit Category Modal Component -->
                            @include('components.edit-categories-admin-modal')
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts')
    <script src="{{ asset('js/admin/categories/index') }}"></script>
@endpush --}}
