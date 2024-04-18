@component('mail::message')
# Нова поръчка

Имате нова поръчка от клиент. Ето детайлите:

## Информация за клиента
**Имейл:** {{ $customer['email'] }}
**Име:** {{ $customer['first_name'] }} {{ $customer['last_name'] }}
**Телефонен номер:** {{ $customer['phone'] }}
**Адрес:** {{ $customer['street'] }}, {{ $customer['city'] }}, {{ $customer['postcode'] }}

@component('mail::table')
| Продукт | Количество | Цена  | Междинна сума |
|---------|----------|----------------|----------|
@foreach($cart['products'] as $item)
| {{ $item['name'] }} | {{ $item['quantity'] }} | {{ $item['price'] }} лв | {{ number_format($item['price'] * $item['quantity'], 2) }} лв |
@endforeach
@endcomponent

**Общо: {{ $payment['totalAmount'] }} лв**
**Метод на плащане:** {{ $payment['method'] }}

Благодарим,<br>
{{ config('app.name') }}
@endcomponent
