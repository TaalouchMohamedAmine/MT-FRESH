<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\ManageCategories;
use App\Models\Category;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name.en')->label('Name (English)')->required()->maxLength(100),
                TextInput::make('name.fr')->label('Nom (français)')->required()->maxLength(100),
                TextInput::make('name.ar')->label('الاسم (العربية)')->required()->maxLength(100),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(120),
                FileUpload::make('image_path')->image()->maxSize(5120)->disk('public')->directory('categories')->imageEditor(),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
                Toggle::make('is_available')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name.fr')->label('Nom')->searchable(query: fn ($query, $search) => $query->whereRaw("name->>'fr' ilike ?", ["%{$search}%"])),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('products_count')->counts('products')->label('Produits'),
                ToggleColumn::make('is_available'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCategories::route('/'),
        ];
    }
}
