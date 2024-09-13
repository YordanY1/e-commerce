<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Columns\TextColumn;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            BelongsToSelect::make('product_id')
                ->relationship('product', 'name')
                ->required(),
            TextInput::make('quantity')
                ->numeric()
                ->required(),
            TextInput::make('price')
                ->numeric()
                ->required(),
            TextInput::make('total')
                ->numeric()
                ->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('product.name')->label('Продукт'),
            TextColumn::make('quantity')->label('Количество'),
            TextColumn::make('price')
                ->label('Цена')
                ->formatStateUsing(fn ($state) => number_format($state, 2) . ' лв'),
            TextColumn::make('total')
                ->label('Общо')
                ->formatStateUsing(fn ($state) => number_format($state, 2) . ' лв'),
        ]);
    }
}
