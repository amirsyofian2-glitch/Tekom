<?php

namespace App\Filament\Widgets;

use App\Models\UserActivity;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentActivitiesWidget extends TableWidget
{
    protected static bool $isHidden = true;

    public static function canView(): bool
    {
        return false;
    }
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                UserActivity::query()
                    ->with('user')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('action')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'viewed' => 'info',
                        'exported' => 'gray',
                        default => 'gray',
                    }),
                    
                TextColumn::make('module')
                    ->label('Modul')
                    ->badge()
                    ->color('primary'),
                    
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),
                    
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('user_agent')
                    ->label('Browser')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(30),
                    
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([5, 10, 25]);
    }
    
    public function getHeading(): string
    {
        return 'Aktivitas Terbaru';
    }
}
