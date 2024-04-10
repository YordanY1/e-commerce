@extends('layouts.home.layout')

@section('content')
<div class="container text-center">
    <h1>Плащането е успешно</h1>
    <p>Благодарим Ви за поръчката. Вашата транзакция е завършена и разписка за покупката ви е изпратена по имейл.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Върни се на началната страница</a>
</div>
@endsection

<script>
    localStorage.removeItem('cart');
</script>
