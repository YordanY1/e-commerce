<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Columns\TextColumn;


class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'Клиентска част';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            BelongsToSelect::make('order_id')
                ->relationship('order', 'order_number')
                ->required(),
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

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('order.order_number')
                ->label('Номер на поръчка')
                ->searchable(),
            TextColumn::make('product.name')
                ->label('Продукт')
                ->searchable(),
            TextColumn::make('quantity')
                ->label('Количество'),
            TextColumn::make('price')
                ->label('Цена')
                ->formatStateUsing(fn ($state) => number_format($state, 2) . ' лв')
                ->sortable(),
            TextColumn::make('total')
                ->label('Общо')
                ->formatStateUsing(fn ($state) => number_format($state, 2) . ' лв')
                ->sortable(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
