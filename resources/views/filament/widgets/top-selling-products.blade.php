<x-filament::widget>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Топ 5 най-продавани продукти</h2>
        <ul>
            @foreach($products as $product)
                <li class="mb-2">
                    {{ $product->name }} - {{ $product->total_quantity }} продадени
                </li>
            @endforeach
        </ul>
    </x-filament::card>
</x-filament::widget>
