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

</style>

<div class="container">
    <img src="https://i.imgur.com/Z3IT6TQ.jpg" alt="Logo" class="logo">
</div>

# Потвърждение на поръчка

Благодарим Ви за поръчката! Ще се свържем с вас, за да уточним детайлите по нея! Ето детайли за вашата поръчка:

@component('mail::table')
| Продукт | Код      | Количество | Единична цена | Междинна сума |
|---------|----------|------------|---------------|---------------|
@foreach($cart['products'] as $item)
| {{ $item['name'] }} | {{ $item['code'] }} | {{ $item['quantity'] }} | {{ $item['price'] }} лв | {{ number_format($item['price'] * $item['quantity'], 2) }} лв |
@endforeach
@endcomponent

**Общо сума:** {{ $payment['totalAmount'] }} лв



Благодарим Ви още веднъж, че избрахте {{ config('app.name') }}. Очакваме да Ви доставим поръчката възможно най-скоро!

С уважение,<br>
Екипът на {{ config('app.name') }}

@endcomponent
