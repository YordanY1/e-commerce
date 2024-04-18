@component('mail::message')
# Нова поръчка получена

Получена е нова поръчка от клиент. По-долу са детайлите:

## Информация за клиента
**Имейл:** {{ $customer['email'] }}
**Име:** {{ $customer['first_name'] }} {{ $customer['last_name'] }}
**Телефонен номер:** {{ $customer['phone'] }}
**Адрес:** {{ $customer['street'] }}, {{ $customer['city'] }}, {{ $customer['postcode'] }}

## Обобщение на поръчката
@component('mail::table')
| Артикул       | Количество | Единична цена | Общо   |
|--------------|------------|---------------|--------|
@foreach($cart['products'] as $item)
| {{ $item['name'] }} | {{ $item['quantity'] }} | {{ number_format($item['price'], 2) }} лв | {{ number_format($item['price'] * $item['quantity'], 2) }} лв |
@endforeach
@endcomponent

**Общо сума:** {{ number_format($payment['totalAmount'], 2) }} лв
<br/>
**Метод на плащане:** {{ $payment['method'] }}

Благодарим Ви, че избрахте {{ config('app.name') }}!
@endcomponent
