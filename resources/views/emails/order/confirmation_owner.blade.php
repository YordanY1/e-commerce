@component('mail::message')
# Нова поръчка получена

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


**Общо сума:** {{ number_format($payment['totalAmount'], 2) }} лв
<br/>

**Метод на плащане:**
@if ($payment['method'] === 'card')
    `Карта, през платформата на Stripe. Доставката се заплаща на куриера`
@elseif ($payment['method'] === 'cod')
    `Плащане с наложен платеж`
@endif


Благодарим Ви, че избрахте {{ config('app.name') }}!
@endcomponent
