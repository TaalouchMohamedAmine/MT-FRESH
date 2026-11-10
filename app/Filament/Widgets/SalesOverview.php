<?php

namespace App\Filament\Widgets;

use App\Models\BusinessSetting;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class SalesOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Orders today', Order::query()->whereDate('created_at', today())->where('status', '!=', 'cancelled')->count())
                ->description('Orders received today')
                ->icon('heroicon-o-shopping-bag'),
            Stat::make('Revenue this week', number_format((float) Order::query()->where('status', 'delivered')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total'), 3).' '.BusinessSetting::current()->currency)
                ->description('Delivered orders')
                ->icon('heroicon-o-banknotes'),
        ];
    }
}
