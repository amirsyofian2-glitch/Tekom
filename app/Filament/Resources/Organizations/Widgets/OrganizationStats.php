<?php

namespace App\Filament\Resources\Organizations\Widgets;

use App\Models\Organization;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrganizationStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Satuan Kerja', Organization::count())
                ->description('Semua satuan kerja terdaftar')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('primary'),
            Stat::make('Satuan Kerja Aktif', Organization::where('is_active', true)->count())
                ->description('Satuan kerja yang aktif')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Satuan Kerja Non-Aktif', Organization::where('is_active', false)->count())
                ->description('Satuan kerja yang tidak aktif')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
