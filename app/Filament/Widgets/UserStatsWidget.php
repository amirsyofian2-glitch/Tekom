<?php

namespace App\Filament\Widgets;

use App\Models\Role;
use App\Models\User;
use App\Models\UserActivity;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends StatsOverviewWidget
{
    protected static bool $isHidden = true;

    public static function canView(): bool
    {
        return false;
    }
    
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Semua pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
                
            Stat::make('Peran Aktif', Role::where('is_active', true)->count())
                ->description('Peran pengguna yang aktif')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('primary'),
                
            Stat::make('Aktivitas Hari Ini', UserActivity::whereDate('created_at', today())->count())
                ->description('Aktivitas yang tercatat hari ini')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([3, 5, 2, 8, 4, 6, 7]),
                
            Stat::make('Minggu Ini', UserActivity::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count())
                ->description('Aktivitas minggu ini')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('info'),
        ];
    }
}
