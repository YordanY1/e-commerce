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
| Артикул       | Количество | Единична цена | Общо   |
|--------------|------------|---------------|--------|
@foreach($cart['products'] as $item)
| {{ $item['name'] }} | {{ $item['quantity'] }} | {{ number_format((float) $item['price'], 2) }} лв | {{ number_format((float) $item['price'] * (int) $item['quantity'], 2) }} лв |
@endforeach
@endcomponent

**Общо сума:** {{ number_format($payment['totalAmount'], 2) }} лв
<br/>
**Метод на плащане:** {{ $payment['method'] }}

Благодарим Ви, че избрахте {{ config('app.name') }}!
@endcomponent
