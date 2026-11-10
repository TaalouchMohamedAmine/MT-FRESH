<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasLocalizedFields;

    protected $fillable = ['name', 'slug', 'image_path', 'is_available', 'sort_order'];

    protected function casts(): array
    {
        return ['name' => 'array', 'is_available' => 'boolean'];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderBy('sort_order');
    }
}
