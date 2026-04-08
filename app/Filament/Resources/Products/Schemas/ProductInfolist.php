<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Details')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('product_id'),
                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('description')
                                    ->label('Product Description'),
                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info')
                            ]),
                        Tab::make('Product Price and Stock')
                            ->icon('heroicon-o-currency-yen')
                            ->badge(fn($record) => $record->stock)
                            ->badgeColor(fn($record) => $record->stock <= 5 ? 'danger' : 'success')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-s-currency-dollar'),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                            ]),
                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                IconEntry::make('is_active')
                                    ->label('Active')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured')
                                    ->boolean(),
                            ]),
                    ])
                    ->columnSpanFull()
                //    ->vertical(),
                // Section::make('Product Info')
                //     ->schema([
                //         TextEntry::make('name')
                //             ->label('Product Name')
                //             ->weight('bold')
                //             ->color('primary'),
                //         TextEntry::make('product_id')
                //             ->label('Product ID'),
                //         TextEntry::make('sku')
                //             ->label('Product SKU')
                //             ->badge()
                //             ->color('primary'),
                //         TextEntry::make('description')
                //             ->label('Product Description'),
                //         TextEntry::make('created_at')
                //             ->label('Product Creation Date')
                //             ->date('d M Y')
                //             ->color('info'),
                //     ])->columnSpanFull(),
                // Section::make('Pricing & Stock')
                //     ->schema([
                //         TextEntry::make('price')
                //             ->label('Product Price')
                //             ->formatStateUsing(fn (string $state): string => 'Rp' . number_format($state, 0, ',', '.'))
                //             ->icon('heroicon-o-currency-dollar'),
                //         TextEntry::make('stock')
                //             ->label('Product Stock')
                //             ->icon('heroicon-o-rectangle-stack'),
                //     ])->columnSpanFull(),
                // Section::make('Media & Status')
                //     ->schema([
                //         ImageEntry::make('image')
                //             ->label('Product Image')
                //             ->disk('public'),
                //         IconEntry::make('is_active')
                //             ->label('Is Active')
                //             ->boolean(),
                //         IconEntry::make('is_featured')
                //             ->label('Is Featured')
                //             ->boolean(),
                //     ])->columnSpanFull()
            ]);
    }
}
