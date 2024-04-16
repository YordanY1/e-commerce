@extends('layouts.terms.layout')

@section('content')
<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
    }

    .terms-content > * {
        margin-bottom: 30px;
        background: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container">
    <div class="terms-content">
        @include('terms.general-terms')
        @include('terms.cookie-policy')
        @include('terms.privacy-policy')
    </div>
</div>
@endsection
