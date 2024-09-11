<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\Price;
use App\Models\ProductAttribute;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        $this->record->price()->updateOrCreate(
            ['product_id' => $this->record->id],
            ['price' => $data['price'], 'cost' => $data['cost'] ?? null, 'margin' => $data['margin'] ?? null]
        );

        $this->record->attributes()->updateOrCreate(
            ['product_id' => $this->record->id],
            ['description' => $data['description'], 'categories' => $data['categories']]
        );

        if (!empty($data['image'])) {
            $this->record->images()->updateOrCreate(
                ['product_id' => $this->record->id],
                ['path' => $data['image']]
            );
        }
    }
}
