<?php

namespace App\Filament\Pages;

use App\Models\BusinessSetting;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Concerns\InteractsWithForms;
use BackedEnum;
use UnitEnum;

class BusinessSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Business settings';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 100;

    protected string $view = 'filament.pages.business-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(BusinessSetting::current()->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Business details')->columns(2)->schema([
                    TextInput::make('business_name.en')->label('Business name (English)')->required(),
                    TextInput::make('business_name.fr')->label('Nom commercial (français)')->required(),
                    TextInput::make('business_name.ar')->label('اسم النشاط (العربية)')->required(),
                    TextInput::make('phone')->tel()->maxLength(40),
                    TextInput::make('whatsapp_number')->label('WhatsApp')->tel()->maxLength(40),
                    TextInput::make('currency')->length(3)->default('TND')->required(),
                    TextInput::make('delivery_fee')->numeric()->minValue(0)->step('0.001')->default(0)->required(),
                    TextInput::make('location.en')->label('Location (English)'),
                    TextInput::make('location.fr')->label('Adresse (français)'),
                    TextInput::make('location.ar')->label('الموقع (العربية)'),
                ]),
                Section::make('Opening hours')->columns(2)->schema([
                    ...collect(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])
                        ->flatMap(fn (string $day) => [
                            TimePicker::make("opening_hours.{$day}.open")->label(ucfirst($day).' opens')->seconds(false),
                            TimePicker::make("opening_hours.{$day}.close")->label(ucfirst($day).' closes')->seconds(false),
                        ])->all(),
                    TextInput::make('opening_hours.summary.en')->label('Hours summary (English)'),
                    TextInput::make('opening_hours.summary.fr')->label('Résumé des horaires (français)'),
                    TextInput::make('opening_hours.summary.ar')->label('ملخص ساعات العمل (العربية)'),
                ]),
                Section::make('Customer reviews')->description('Add real customer feedback to display on the home page.')->schema([
                    Repeater::make('reviews')->schema([
                        TextInput::make('name')->required()->maxLength(100),
                        TextInput::make('rating')->numeric()->minValue(1)->maxValue(5)->default(5)->required(),
                        Textarea::make('quote.en')->label('Review (English)')->rows(2),
                        Textarea::make('quote.fr')->label('Avis (français)')->rows(2),
                        Textarea::make('quote.ar')->label('التقييم (العربية)')->rows(2),
                    ])->columns(2)->defaultItems(0)->maxItems(6)->collapsed(),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        BusinessSetting::current()->fill($this->form->getState())->save();

        Notification::make()->title('Business settings saved')->success()->send();
    }
}
