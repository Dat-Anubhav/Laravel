<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\product;
use App\Models\post;
use Filament\Support\Icons\Heroicon;
class TestStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;
    
    // Renders first at the very top of the dashboard
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $userData = $this->getMonthlyChartData(User::class);
        $productChartData = $this->getMonthlyChartData(Product::class);
        $postData = $this->getMonthlyChartData(Post::class);

        $userQuery = User::query();
        $productQuery = Product::query();
        $postQuery = Post::query();

        if ($startDate) {
            $userQuery->whereDate('created_at', '>=', $startDate);
            $productQuery->whereDate('created_at', '>=', $startDate);
            $postQuery->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $userQuery->whereDate('created_at', '<=', $endDate);
            $productQuery->whereDate('created_at', '<=', $endDate);
            $postQuery->whereDate('created_at', '<=', $endDate);
        }

        $descriptionSuffix = ($startDate || $endDate) ? "in selected range" : "for this year";

        return [
            Stat::make("Total users", $userQuery->count())
                ->description("Total number of users " . $descriptionSuffix)
                ->descriptionColor("success")
                ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
                ->chart($userData)
                ->color("success"),

            Stat::make("Total Products", $productQuery->count())
                ->description("Total number of products " . $descriptionSuffix)
                ->descriptionColor("danger")
                ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
                ->chart($productChartData)
                ->color("danger"),

            Stat::make("Total Posts", $postQuery->count())
                ->description("Total number of posts " . $descriptionSuffix)
                ->descriptionColor("primary")
                ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
                ->chart($postData)
                ->color("primary")
        ];
    }

    protected function getMonthlyChartData(string $modelClass): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $query = $modelClass::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if (!$startDate && !$endDate) {
            $query->whereYear('created_at', now()->year);
        }

        $historyData = $query->selectRaw("EXTRACT(MONTH from created_at) as month, COUNT(*) as count")
            ->groupBy("month")
            ->orderBy("month")
            ->pluck("count", "month")
            ->toArray();

        // Fill in missing months with 0 so the sparkline chart looks smooth and accurate
        $monthlyCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyCounts[] = $historyData[$month] ?? 0;
        }

        return $monthlyCounts;
    }
}
