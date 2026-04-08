<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\ProductCategory;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-shopping-bag';
    protected static string|\UnitEnum|null $navigationGroup = 'Store';
    protected static ?int $navigationSort = 1;
    protected static ?string $label = 'Produk';
    protected static ?string $pluralLabel = 'Produk';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Select::make('product_category_id')
                ->label('Kategori')
                ->options(ProductCategory::pluck('name', 'id'))
                ->searchable(),
            TextInput::make('price')->numeric()->required()->prefix('Rp'),
            Toggle::make('is_available')->default(true)->label('Tersedia'),
            Textarea::make('description')->rows(4)->columnSpanFull(),
            Repeater::make('images')
                ->relationship()
                ->schema([
                    TextInput::make('image_path')->required()->label('Path / URL Gambar'),
                    TextInput::make('order')->numeric()->default(0),
                    Toggle::make('is_primary')->label('Gambar Utama'),
                ])
                ->columnSpanFull()
                ->label('Gambar Produk'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Kategori'),
                TextColumn::make('price')->money('IDR')->sortable(),
                IconColumn::make('is_available')->label('Tersedia')->boolean(),
            ])
            ->filters([
                SelectFilter::make('product_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
            ])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
