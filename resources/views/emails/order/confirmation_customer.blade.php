
@component('mail::message')

<style>
    .container {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo {
        max-width: 100%;
        height: auto;
    }

    .product-info {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 1px solid #e6e6e6;
        padding-bottom: 10px;
    }

    .product-image {
        margin-right: 20px;
    }

    .product-image img {
        max-width: 100px;
        height: auto;
    }

    .total {
        font-weight: bold;
        font-size: 20px;
    }

    .thanks {
        color: #4CAF50;
        font-size: 18px;
    }

</style>

<div class="container">
    <img src="https://i.imgur.com/Z3IT6TQ.jpg" alt="Logo" class="logo">
</div>

# Потвърждение на поръчка

Благодарим Ви за поръчката! Ще се свържем с вас, за да уточним детайлите по нея! Ето информация за вашата поръчка:

@foreach($cart['products'] as $item)
<div class="product-info">
    <div class="product-image">
        <img src="{{ Str::startsWith($item['image'], ['http', 'https']) ? $item['image'] : asset('storage/images/'.$item['image']) }}" alt="{{ $item['name'] }}">
    </div>
    <div>
        <p><strong>{{ $item['name'] }}</strong></p>
        <p>Код: {{ $item['code'] }}</p>
        <p>Количество: {{ $item['quantity'] }}</p>
        <p>Цена: {{ $item['price'] }} лв</p>
        <p>Общо: {{ $item['price'] * $item['quantity'] }} лв</p>
    </div>
</div>
@endforeach

<p class="total">**Общо сума:** {{ $payment['totalAmount'] }} лв</p>


<p class="thanks">Благодарим Ви още веднъж, че избрахте {{ config('app.name') }}. Очакваме да Ви доставим поръчката възможно най-скоро!</p>

С уважение,<br>
Екипът на {{ config('app.name') }}

@endcomponent
