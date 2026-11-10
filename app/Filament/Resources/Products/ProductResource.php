<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\ManageProducts;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'slug';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')->relationship('category', 'slug')->getOptionLabelFromRecordUsing(fn ($record) => $record->translated('name', 'fr'))->required()->searchable()->preload(),
                TextInput::make('name.en')->label('Name (English)')->required()->maxLength(120),
                TextInput::make('name.fr')->label('Nom (français)')->required()->maxLength(120),
                TextInput::make('name.ar')->label('الاسم (العربية)')->required()->maxLength(120),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(140),
                Textarea::make('description.en')->label('Description (English)')->required()->rows(3)->columnSpanFull(),
                Textarea::make('description.fr')->label('Description (français)')->required()->rows(3)->columnSpanFull(),
                Textarea::make('description.ar')->label('الوصف (العربية)')->required()->rows(3)->columnSpanFull(),
                FileUpload::make('image_path')->image()->maxSize(5120)->disk('public')->directory('products')->imageEditor()->columnSpanFull(),
                Toggle::make('is_available')->default(true),
                Toggle::make('is_featured')->default(false),
                TextInput::make('sort_order')->numeric()->default(0)->required(),
                Repeater::make('sizes')->relationship()->schema([
                    TextInput::make('label.en')->label('Size (English)')->required()->maxLength(80),
                    TextInput::make('label.fr')->label('Taille (français)')->required()->maxLength(80),
                    TextInput::make('label.ar')->label('الحجم (العربية)')->required()->maxLength(80),
                    TextInput::make('volume_ml')->label('Volume (ml)')->numeric()->minValue(1),
                    TextInput::make('price')->numeric()->minValue(0)->required()->step('0.001'),
                    Toggle::make('is_available')->default(true),
                    TextInput::make('sort_order')->numeric()->default(0)->required(),
                ])->columns(3)->defaultItems(1)->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name.fr')->label('Nom')->searchable(query: fn ($query, $search) => $query->whereRaw("name->>'fr' ilike ?", ["%{$search}%"])),
                TextColumn::make('category.name.fr')->label('Catégorie'),
                TextColumn::make('sizes_count')->counts('sizes')->label('Tailles'),
                ToggleColumn::make('is_available'),
                ToggleColumn::make('is_featured'),
            ])
            ->filters([
                SelectFilter::make('category')->relationship('category', 'slug'),
                SelectFilter::make('is_available')->options([true => 'Available', false => 'Unavailable']),
                SelectFilter::make('is_featured')->options([true => 'Featured', false => 'Not featured']),
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
            'index' => ManageProducts::route('/'),
        ];
    }
}
