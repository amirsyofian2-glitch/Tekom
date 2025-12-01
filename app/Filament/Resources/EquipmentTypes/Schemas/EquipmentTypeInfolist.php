<?php

namespace App\Filament\Resources\EquipmentTypes\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EquipmentTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Informasi Perangkat')
                            ->icon('heroicon-o-cpu-chip')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Nama Perangkat')
                                            ->weight('bold')
                                            ->size('lg'),
                                        TextEntry::make('category')
                                            ->label('Kategori')
                                            ->badge()
                                            ->color('info'),
                                        TextEntry::make('brand')
                                            ->label('Merk / Brand')
                                            ->icon('heroicon-o-tag')
                                            ->placeholder('-'),
                                    ]),
                            ]),

                        Section::make('Spesifikasi')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextEntry::make('specifications')
                                    ->label('Detail Spesifikasi')
                                    ->markdown()
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
