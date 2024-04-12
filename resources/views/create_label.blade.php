{{-- resources/views/create_label.blade.php --}}
@extends('layouts.checkout.layout')

@section('content')
<div class="container">
    <h1>Create Shipping Label</h1>
    <form action="{{ route('econt.labels.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="receiverName">Receiver Name:</label>
            <input type="text" class="form-control" id="receiverName" name="label[receiverClient][name]" required>
        </div>
        <div class="form-group">
            <label for="receiverPhone">Receiver Phone:</label>
            <input type="text" class="form-control" id="receiverPhone" name="label[receiverClient][phones][]" required>
        </div>
        <!-- Add additional fields as necessary -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
