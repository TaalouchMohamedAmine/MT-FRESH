<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\ManageOrders;
use App\Models\Order;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'order_number';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Placeholder::make('order_number')->content(fn (?Order $record) => $record?->order_number),
                Placeholder::make('customer')->content(fn (?Order $record) => $record ? $record->customer_name.' · '.$record->phone : '—'),
                Placeholder::make('delivery')->content(fn (?Order $record) => $record?->fulfillment_type === 'delivery' ? $record->address : 'Pickup'),
                Placeholder::make('total')->content(fn (?Order $record) => $record ? number_format((float) $record->total, 3).' '.$record->currency : '—'),
                Select::make('status')->options(['new' => 'New', 'preparing' => 'Preparing', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'])->required(),
                Placeholder::make('items')->content(fn (?Order $record) => $record?->items()->get()->map(fn ($item) => "{$item->quantity} × {$item->product_name} ({$item->size_label})")->join(', ') ?: '—')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->searchable()->sortable(),
                TextColumn::make('customer_name')->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('fulfillment_type')->badge(),
                TextColumn::make('total')->money(fn (Order $record) => $record->currency)->sortable(),
                TextColumn::make('status')->badge()->color(fn (string $state) => match ($state) {'new' => 'warning', 'preparing' => 'info', 'delivered' => 'success', 'cancelled' => 'danger', default => 'gray'}),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->options(['new' => 'New', 'preparing' => 'Preparing', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']),
                SelectFilter::make('fulfillment_type')->options(['delivery' => 'Delivery', 'pickup' => 'Pickup']),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageOrders::route('/'),
        ];
    }
}
