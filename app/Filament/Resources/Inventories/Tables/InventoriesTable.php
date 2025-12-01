<?php

namespace App\Filament\Resources\Inventories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InventoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asset_code')
                    ->label('Kode Aset')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('organization.name')
                    ->label('Satuan Kerja')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                
                TextColumn::make('unit')
                    ->label('Unit')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                    
                TextColumn::make('site.name')
                    ->label('Lokasi Site')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: false),
                    
                TextColumn::make('equipmentType.name')
                    ->label('Jenis Perangkat')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('installation_year')
                    ->label('Tahun Install')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('condition')
                    ->label('Kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'BB' => 'success',
                        'RR' => 'warning',
                        'RB' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'BB' => 'Baik',
                        'RR' => 'Rusak Ringan',
                        'RB' => 'Rusak Berat',
                    }),
                    
                TextColumn::make('quantity')
                    ->label('Qty')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('next_maintenance')
                    ->label('Maintenance Selanjutnya')
                    ->date('d/m/Y')
                    ->sortable()
                    ->color(fn ($state) => $state && $state->isPast() ? 'danger' : 'success')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('condition')
                    ->label('Kondisi')
                    ->options([
                        'BB' => 'Baik (BB)',
                        'RR' => 'Rusak Ringan (RR)',
                        'RB' => 'Rusak Berat (RB)',
                    ]),
                    
                SelectFilter::make('organization')
                    ->label('Organisasi')
                    ->relationship('organization', 'name')
                    ->searchable()
                    ->preload(),
                
                SelectFilter::make('site')
                    ->label('Lokasi Site')
                    ->relationship('site', 'name')
                    ->searchable()
                    ->preload(),
                    
                SelectFilter::make('equipmentType')
                    ->label('Jenis Perangkat')
                    ->relationship('equipmentType', 'name')
                    ->searchable()
                    ->preload(),
                
                Filter::make('installation_year')
                    ->form([
                        \Filament\Forms\Components\Select::make('year_from')
                            ->label('Dari Tahun')
                            ->options(function () {
                                $currentYear = now()->year;
                                $years = [];
                                for ($i = $currentYear; $i >= 2000; $i--) {
                                    $years[$i] = $i;
                                }
                                return $years;
                            }),
                        \Filament\Forms\Components\Select::make('year_until')
                            ->label('Sampai Tahun')
                            ->options(function () {
                                $currentYear = now()->year;
                                $years = [];
                                for ($i = $currentYear; $i >= 2000; $i--) {
                                    $years[$i] = $i;
                                }
                                return $years;
                            }),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['year_from'],
                                fn (Builder $query, $year): Builder => $query->where('installation_year', '>=', $year),
                            )
                            ->when(
                                $data['year_until'],
                                fn (Builder $query, $year): Builder => $query->where('installation_year', '<=', $year),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['year_from'] ?? null) {
                            $indicators[] = 'Dari: ' . $data['year_from'];
                        }
                        if ($data['year_until'] ?? null) {
                            $indicators[] = 'Sampai: ' . $data['year_until'];
                        }
                        return $indicators;
                    }),
                    
                SelectFilter::make('is_active')
                    ->label('Status Aktif')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
