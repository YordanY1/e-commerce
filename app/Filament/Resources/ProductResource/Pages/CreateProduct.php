<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\Price;
use App\Models\ProductAttribute;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        $data = $this->form->getState();

        // Създаване на цена
        Price::create([
            'product_id' => $this->record->id,
            'price' => $data['price'],
            'cost' => $data['cost'] ?? null,
            'margin' => $data['margin'] ?? null,
        ]);

        ProductAttribute::create([
            'product_id' => $this->record->id,
            'description' => $data['description'],
            'categories' => $data['categories'],
        ]);

        if (!empty($data['image'])) {
            $this->record->images()->create([
                'path' => $data['image'],
            ]);
        }
    }
}
