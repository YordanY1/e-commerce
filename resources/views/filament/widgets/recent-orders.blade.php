<x-filament::widget>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Последни поръчки</h2>
        <ul>
            @foreach($orders as $order)
                <li class="mb-2">
                    {{ $order->created_at->format('d.m.Y H:i') }} - Поръчка #{{ $order->order_number }} - {{ number_format($order->total_amount, 2) }} лв - {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                </li>
            @endforeach
        </ul>
    </x-filament::card>
</x-filament::widget>
