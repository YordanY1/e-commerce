<x-filament::widget>
    <x-filament::card>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="text-center">
                <div class="text-lg font-medium">{{ $totalSales }}</div>
                <div class="text-sm text-gray-500">Общи продажби</div>
            </div>
            <div class="text-center">
                <div class="text-lg font-medium">{{ $orderCount }}</div>
                <div class="text-sm text-gray-500">Брой поръчки</div>
            </div>
            <div class="text-center">
                <div class="text-lg font-medium">{{ $customerCount }}</div>
                <div class="text-sm text-gray-500">Брой клиенти</div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
