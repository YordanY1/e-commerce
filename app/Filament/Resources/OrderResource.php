<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Клиентска част';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            BelongsToSelect::make('customer_id')
                ->relationship('customer', 'email')
                ->searchable()
                ->required(),
            TextInput::make('order_number')->disabled(),
            TextInput::make('total_amount')->disabled(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('order_number')->searchable()->sortable(),
            TextColumn::make('customer.email')->label('Email')->searchable(),
            TextColumn::make('total_amount')
            ->label('Общо')
            ->formatStateUsing(fn ($state) => number_format($state, 2) . ' лв')
            ->sortable(),
            TextColumn::make('created_at')->dateTime(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
