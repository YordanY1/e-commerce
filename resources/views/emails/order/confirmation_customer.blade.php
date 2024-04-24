@component('mail::message')
# Потвърждение на поръчка

Благодарим Ви за поръчката! Ще се свържем с вас, за да уточним детайлите по нея! Ето детайли за вашата поръчка:

@component('mail::table')
| Продукт | Код      | Количество | Единична цена | Междинна сума |
|---------|----------|------------|---------------|---------------|
@foreach($cart['products'] as $item)
| {{ $item['name'] }} | {{ $item['code'] }} | {{ $item['quantity'] }} | {{ $item['price'] }} лв | {{ number_format($item['price'] * $item['quantity'], 2) }} лв |
@endforeach
@endcomponent

**Общо: {{ number_format((float)$payment['totalAmount'], 2) }} лв**

Благодарим,<br>
{{ config('app.name') }}
@endcomponent
