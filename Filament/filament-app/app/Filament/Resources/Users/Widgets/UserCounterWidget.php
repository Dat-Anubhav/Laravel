<?php

namespace App\Filament\Resources\Users\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class UserCounterWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
            ->description("All registered accounts")
            ->descriptionColor("success")
            ->color("success"),
        ];
    }
}
