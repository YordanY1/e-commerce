@component('mail::message')
# Потвърждение на поръчка

Благодарим Ви за поръчката! Ето детайли за вашата поръчка:

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

Благодарим,<br>
{{ config('app.name') }}
@endcomponent
