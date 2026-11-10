<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class BestSellingJuices extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->heading('Best-selling juices')
            ->query(fn (): Builder => OrderItem::query()
                ->select('product_name')
                ->selectRaw('SUM(quantity) AS quantity_sold')
                ->whereHas('order', fn (Builder $orders) => $orders->where('status', 'delivered'))
                ->groupBy('product_name')
                ->orderByDesc('quantity_sold')
                ->limit(5))
            ->columns([
                TextColumn::make('product_name')->label('Juice'),
                TextColumn::make('quantity_sold')->label('Units sold')->numeric(),
            ])
            ->paginated(false);
    }
}
