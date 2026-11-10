<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasLocalizedFields;

    protected $fillable = [
        'business_name', 'phone', 'whatsapp_number', 'opening_hours', 'delivery_fee', 'currency', 'location', 'reviews',
    ];

    protected function casts(): array
    {
        return [
            'business_name' => 'array',
            'opening_hours' => 'array',
            'location' => 'array',
            'reviews' => 'array',
            'delivery_fee' => 'decimal:3',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'business_name' => ['en' => 'MT FRESH', 'fr' => 'MT FRESH', 'ar' => 'MT FRESH'],
            'opening_hours' => static::defaultOpeningHours(),
            'delivery_fee' => 0,
            'currency' => 'TND',
        ]);
    }

    public static function defaultOpeningHours(): array
    {
        $hours = [];

        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
            $hours[$day] = ['open' => '07:30', 'close' => '20:00'];
        }

        $hours['summary'] = [
            'en' => '7:30 AM – 8:00 PM',
            'fr' => '7 h 30 – 20 h 00',
            'ar' => '٧:٣٠ صباحاً – ٨:٠٠ مساءً',
        ];

        return $hours;
    }
}
