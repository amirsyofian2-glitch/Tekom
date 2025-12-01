<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Site')
                            ->icon('heroicon-o-signal')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Nama Site')
                                            ->weight('bold')
                                            ->size('lg')
                                            ->columnSpanFull(),
                                        TextEntry::make('ownership')
                                            ->label('Status Kepemilikan')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'POLRI' => 'success',
                                                'PINJAM PAKAI' => 'warning',
                                                'SEWA' => 'danger',
                                                default => 'gray',
                                            })
                                            ->placeholder('-'),
                                        TextEntry::make('towers_count')
                                            ->label('Jumlah Tower')
                                            ->state(fn ($record) => $record->towers()->count())
                                            ->badge()
                                            ->color('info')
                                            ->icon('heroicon-o-bars-3-bottom-left')
                                            ->placeholder('0'),
                                    ]),
                            ]),

                        Section::make('Lokasi & Keterangan')
                            ->icon('heroicon-o-map')
                            ->schema([
                                TextEntry::make('coordinates')
                                    ->label('Koordinat (Lat, Long)')
                                    ->state(fn ($record) => filled($record->latitude) && filled($record->longitude)
                                        ? sprintf('%s, %s', $record->latitude, $record->longitude)
                                        : null)
                                    ->fontFamily('mono')
                                    ->copyable()
                                    ->icon('heroicon-o-map-pin')
                                    ->placeholder('-'),
                                TextEntry::make('location')
                                    ->label('Alamat / Lokasi Asli')
                                    ->icon('heroicon-o-home')
                                    ->placeholder('-'),
                                TextEntry::make('description')
                                    ->label('Catatan')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Status')
                            ->icon('heroicon-o-check-circle')
                            ->schema([
                                IconEntry::make('is_active')
                                    ->label('Status Aktif')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
                            ]),

                        Section::make('Metadata')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d F Y H:i')
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d F Y H:i')
                                    ->placeholder('-'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
