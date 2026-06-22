<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class UserChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    //sorting the charts to make them appear in order
    protected static ?int $sort = 2;
    protected ?string $heading = 'User Chart Widget';

    //Adjust height
    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $query = User::selectRaw("EXTRACT(MONTH from created_at) as month, COUNT(*) as count");

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if (!$startDate && !$endDate) {
            $query->whereYear('created_at', now()->year);
        }

        $userData = $query->groupBy("month")
                ->orderBy("month")
                ->pluck("count", "month")
                ->toArray();

        // Fill in missing months with 0 so the sparkline chart looks smooth and accurate
        $monthlyCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            // If a month has no users yet, default its chart plot point to 0
            $monthlyCounts[] = $userData[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users Joined',
                    'data' => $monthlyCounts,
                ],
        ],
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
