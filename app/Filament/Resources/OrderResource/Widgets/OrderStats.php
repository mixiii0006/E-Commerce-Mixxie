<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count())
                ->color('success')
                ->icon('heroicon-o-shopping-cart')
                ->description('New Orders')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('danger')
                ->chart([1, 3,  7,  7, 8, 9, 16, 9, 12]),
            Stat::make('Order Processing', Order::query()->where('status', 'processing')->count())
                ->color('success')
                ->icon('heroicon-m-arrow-path')
                ->description('In Progress')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('success')
                ->chart([1, 6,  7,  12, 8, 9, 16, 9, 12]),
            Stat::make('Order Shipped', Order::query()->where('status', 'shipped')->count())
                ->color('success')
                ->icon('heroicon-o-truck')
                ->description('Shipped Orders')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('primary')
                ->chart([4, 3,  7,  24, 8, 9, 16, 9, 12]),
            Stat::make('Average Price', Number::currency(Order::query()->avg('grand_total'), 'USD'))
                ->color('success')
                ->icon('heroicon-o-currency-dollar')
                ->description('Grand Total')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color('info')
                ->chart([1, 7,  14,  7, 8, 9, 16, 9, 12]),
        ];
    }
}
