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
@component('mail::table')
| Артикул | Код | Количество | Единична цена | Общо   |
|---------|-----|------------|---------------|--------|
@foreach($cart['products'] as $item)
| {{ $item['name'] }} | {{ $item['code'] }} | {{ $item['quantity'] }} | {{ number_format((float) $item['price'], 2) }} лв | {{ number_format((float) $item['price'] * (int) $item['quantity'], 2) }} лв |
@endforeach
@endcomponent


**Общо сума:** {{ $payment['totalAmount'] }} лв

<br/>

**Метод на плащане:**
@if ($payment['method'] === 'card')
    `Карта, през платформата на Stripe. Доставката се заплаща на куриера`
@elseif ($payment['method'] === 'cod')
    `Плащане с наложен платеж`
@endif


Благодарим Ви, че избрахте {{ config('app.name') }}!
@endcomponent
