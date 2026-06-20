<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
class TestStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total users", User::count())
            ->description("Total number of users of this year")
            ->descriptionColor("success")
            ->descriptionIcon(Heroicon::ArrowUpLeft, IconPosition::Before)
            ->chart([5,7,8,9,11,13,15,17])
            ->color("success")
        ];
    }
}
