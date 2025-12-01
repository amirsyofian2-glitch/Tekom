<?php

namespace App\Filament\Resources\Towers\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TowerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Tower')
                            ->icon('heroicon-o-signal')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('site.name')
                                            ->label('Lokasi Site')
                                            ->weight('bold')
                                            ->icon('heroicon-o-map-pin'),
                                        TextEntry::make('repeater_type')
                                            ->label('Tipe Repeater')
                                            ->badge(),
                                        TextEntry::make('system')
                                            ->label('Sistem')
                                            ->badge()
                                            ->color('info'),
                                        TextEntry::make('site_status')
                                            ->label('Status Kepemilikan')
                                            ->badge()
                                            ->color(fn (string $state): string => match ($state) {
                                                'POLRI' => 'success',
                                                'PINJAM PAKAI' => 'warning',
                                                'SEWA' => 'danger',
                                                default => 'gray',
                                            }),
                                        TextEntry::make('tower_structure')
                                            ->label('Jenis Struktur')
                                            ->icon('heroicon-o-bars-3-bottom-left'),
                                        TextEntry::make('tower_height')
                                            ->label('Tinggi Tower')
                                            ->suffix(' Meter'),
                                    ]),
                            ]),

                        Section::make('Frekuensi')
                            ->icon('heroicon-o-radio')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('frequency_rx')
                                            ->label('Frekuensi RX')
                                            ->fontFamily('mono'),
                                        TextEntry::make('frequency_tx')
                                            ->label('Frekuensi TX')
                                            ->fontFamily('mono'),
                                    ]),
                            ]),
                            
                        Section::make('Keterangan Tambahan')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextEntry::make('documentation')
                                    ->label('Dokumentasi')
                                    ->placeholder('-'),
                                TextEntry::make('notes')
                                    ->label('Catatan')
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Kondisi & Pengguna')
                            ->icon('heroicon-o-clipboard-document-check')
                            ->schema([
                                TextEntry::make('condition_bb')
                                    ->label('Kondisi Baik (BB)')
                                    ->numeric(),
                                TextEntry::make('condition_rr')
                                    ->label('Rusak Ringan (RR)')
                                    ->numeric(),
                                TextEntry::make('condition_rb')
                                    ->label('Rusak Berat (RB)')
                                    ->numeric(),
                                TextEntry::make('user')
                                    ->label('Pengguna')
                                    ->icon('heroicon-o-user'),
                            ]),

                        Section::make('Metadata')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                IconEntry::make('site.is_active')
                                    ->label('Status Site Aktif')
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
