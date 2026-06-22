<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\post;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class PostChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 3;
    protected ?string $heading = 'Monthly Posts Distribution';

    protected ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $query = Post::selectRaw("EXTRACT(MONTH from created_at) as month, COUNT(*) as count");

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if (!$startDate && !$endDate) {
            $query->whereYear('created_at', now()->year);
        }

        $postData = $query->groupBy("month")
                ->orderBy("month")
                ->pluck("count", "month")
                ->toArray();

        // Fill in missing months with 0 so the sparkline chart looks smooth and accurate
        $monthlyCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            // If a month has no users yet, default its chart plot point to 0
            $monthlyCounts[] = $postData[$month] ?? 0;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Total Posts',
                    'data' => $monthlyCounts,
                    // Optional: Adding colors gives each month's slice a distinct look
                    'backgroundColor' => [
                        '#f87171', '#fb923c', '#fbbf24', '#facc15', 
                        '#4ade80', '#34d399', '#2dd4bf', '#22d3ee', 
                        '#60a5fa', '#818cf8', '#a78bfa', '#c084fc'
                    ],
                ],
                
        ],
        // Crucial for Pie charts: maps each slice to its respective month
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
