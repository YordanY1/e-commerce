{{-- resources/views/checkout/failure.blade.php --}}
@extends('layouts.checkout.layout')

@section('content')
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Грешка в плащането</h4>
            <p>Има проблем с плащането, моля обърнете се към нас</p>
            <hr>
            <p class="mb-0">Може да ни пишете на jeronimostore1@gmail.com</p>
        </div>
        <a href="{{ url('/') }}" class="btn btn-primary">Return Home</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-secondary">Try Again</a>
    </div>
@endsection
