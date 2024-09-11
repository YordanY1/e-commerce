<?php

namespace App\Filament\Resources\ManufacturerResource\Pages;

use App\Filament\Resources\ManufacturerResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditManufacturer extends EditRecord
{
    protected static string $resource = ManufacturerResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {

        $data['slug'] = Str::slug($data['name']);

        return $data;
    }
}
