<?php

namespace App\Filament\Resources\Inventories\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InventoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Aset')
                            ->icon('heroicon-o-cube')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('asset_code')
                                            ->label('Kode Aset')
                                            ->weight('bold')
                                            ->copyable(),
                                        TextEntry::make('equipmentType.name')
                                            ->label('Jenis Perangkat')
                                            ->badge()
                                            ->color('info'),
                                        TextEntry::make('serial_number')
                                            ->label('Nomor Seri')
                                            ->fontFamily('mono')
                                            ->placeholder('-'),
                                        TextEntry::make('quantity')
                                            ->label('Jumlah')
                                            ->numeric(),
                                        TextEntry::make('purchase_price')
                                            ->label('Harga Pembelian')
                                            ->money('IDR')
                                            ->placeholder('-'),
                                        TextEntry::make('installation_year')
                                            ->label('Tahun Instalasi'),
                                    ]),
                            ]),

                        Section::make('Lokasi & Organisasi')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('organization.name')
                                            ->label('Satuan Kerja')
                                            ->icon('heroicon-o-building-office-2'),
                                        TextEntry::make('site.name')
                                            ->label('Lokasi Site')
                                            ->icon('heroicon-o-map-pin'),
                                    ]),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Status & Kondisi')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                TextEntry::make('condition')
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
                                IconEntry::make('is_active')
                                    ->label('Status Aktif')
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
                            ]),

                        Section::make('Maintenance')
                            ->icon('heroicon-o-wrench-screwdriver')
                            ->schema([
                                TextEntry::make('last_maintenance')
                                    ->label('Maintenance Terakhir')
                                    ->date('d F Y')
                                    ->placeholder('-'),
                                TextEntry::make('next_maintenance')
                                    ->label('Maintenance Selanjutnya')
                                    ->date('d F Y')
                                    ->placeholder('-')
                                    ->color(fn ($state) => $state && $state->isPast() ? 'danger' : 'success'),
                                TextEntry::make('notes')
                                    ->label('Catatan')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Metadata')
                            ->icon('heroicon-o-information-circle')
                            ->collapsed()
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
