<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Date;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders per Month';
    protected static ?int $sort = 2;

    protected static string $color = 'info';

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Date::parse($value->date)->format('M')), // Format the date as a month name
        ];

    }

    protected function getType(): string
    {
        return 'line';
    }
}
