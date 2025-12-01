<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Satuan Kerja')
                            ->icon('heroicon-o-building-office-2')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('code')
                                            ->label('Kode Satuan')
                                            ->copyable()
                                            ->weight('bold')
                                            ->icon('heroicon-m-clipboard'),
                                        TextEntry::make('type')
                                            ->label('Jenis Satuan')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'POLDA' => 'success',
                                                'POLRESTA' => 'info',
                                                'POLRES' => 'warning',
                                                'POLSEK' => 'gray',
                                                'SATUAN' => 'danger',
                                                default => 'gray',
                                            }),
                                        TextEntry::make('name')
                                            ->label('Nama Satuan Kerja')
                                            ->size('lg')
                                            ->weight('bold')
                                            ->columnSpanFull(),
                                        TextEntry::make('address')
                                            ->label('Alamat')
                                            ->placeholder('Alamat tidak tersedia')
                                            ->icon('heroicon-m-map-pin')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Hierarki')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                TextEntry::make('parent.name')
                                    ->label('Satuan Induk')
                                    ->placeholder('Tidak Ada Induk')
                                    ->icon('heroicon-m-building-office')
                                    ->weight('medium'),
                            ]),

                        Section::make('Status & Metadata')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                IconEntry::make('is_active')
                                    ->label('Status Aktif')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
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
