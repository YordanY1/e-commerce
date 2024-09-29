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

</style>

<div class="container">
    <img src="https://i.imgur.com/Z3IT6TQ.jpg" alt="Logo" class="logo">
</div>

# Нова получена поръчка

## Информация за клиента
**Имейл:** {{ $customer['email'] }}
<br/>
**Име:** {{ $customer['first_name'] }} {{ $customer['last_name'] }}
<br/>
**Телефонен номер:** {{ $customer['phone'] }}
<br/>
**Адрес:** {{ $customer['street'] }}, {{ $customer['city'] }}, {{ $customer['postcode'] }}

@if(!empty($invoice) && $invoice['invoiceRequested'])
## Информация за фактурата
**Име на фирмата:** {{ $invoice['companyName'] }}
<br/>
**ЕИК/Булстат:** {{ $invoice['companyID'] }}
<br/>
**Адрес на фирмата:** {{ $invoice['companyAddress'] }}
<br/>
**ДДС Номер:** {{ $invoice['companyTaxNumber'] }}
<br/>
**МОЛ:** {{ $invoice['companyMol'] }}
@endif

## Обобщение на поръчката

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

## Метод на плащане:
@if ($payment['method'] === 'card')
    Карта, през платформата на Stripe. Доставката се заплаща на куриера.
@elseif ($payment['method'] === 'cod')
    Плащане с наложен платеж.
@endif

Благодарим Ви, че избрахте {{ config('app.name') }}!

@endcomponent
