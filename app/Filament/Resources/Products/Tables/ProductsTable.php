<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('sku'),
                TextColumn::make('price')
                    ->formatStateUsing(fn(string $state): string => 'Rp' . number_format($state, 0, ',', '.')),
                TextColumn::make('stock')
                    ->badge(),
                ImageColumn::make('image')
                    ->disk('public'),
                TextColumn::make('is_active')
                    ->badge()
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Aktif' : 'Tidak Aktif')
                    ->color(fn(bool $state): string => $state ? 'success' : 'danger')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
