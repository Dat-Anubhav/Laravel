<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\product;
use App\Models\post;
use Filament\Support\Icons\Heroicon;
class TestStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        //Fetch user data using postgresql query
        $userData = User::selectRaw("EXTRACT(MONTH from created_at) as month, COUNT(*) as count")
                ->whereYear("created_at", now()->year)
                ->groupBy("month")
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
            Stat::make("Total users", User::count())
            ->description("Total number of users of this year")
            ->descriptionColor("success")
            ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
            ->chart($monthlyCounts)
            ->color("success"),

            Stat::make("Total Products", Product::count())
            ->description("Total number of products for this year")
            ->descriptionColor("success")
            ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
            ->chart($monthlyCounts)
            ->color("success"),

            Stat::make("Total Posts", Post::count())
            ->description("Total number of posts for this year")
            ->descriptionColor("success")
            ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
            ->chart($monthlyCounts)
            ->color("success")
        ];

         
          
        
    }
}
