<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\Date;

class CustomerChart extends ChartWidget
{
    protected static ?string $heading = 'Total Customers';
    protected static ?int $sort = 2;

    protected static string $color = 'primary';

    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Customers',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => Date::parse($value->date)->format('M')), // Abbreviated month name
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
