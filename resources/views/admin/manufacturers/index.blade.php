@extends('layouts.manufacturers.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin | Manufacturers</h1>

            <!-- Add New Manufacturer Button -->
           <!-- Trigger/Create Button -->
           <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#createManufacturerModal">
            Add New Manufacturer
        </button>

              <!-- Include Modal Component -->
              @include('components.create-manufacturers-admin-modal')

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Code</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manufacturers as $manufacturer)
                    <tr>
                        <td>{{ $manufacturer->id }}</td>
                        <td>{{ $manufacturer->name }}</td>
                        <td>{{ $manufacturer->slug }}</td>
                        <td>{{ $manufacturer->code }}</td>
                        <!-- Display other fields -->
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary btn-sm" onclick="editManufacturer({{ $manufacturer->id }})">Edit</button>
                            @include('components.create-manufacturers-admin-modal-edit')

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteManufacturer({{ $manufacturer->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
