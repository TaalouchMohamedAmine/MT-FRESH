<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSize extends Model
{
    use HasLocalizedFields;

    protected $fillable = ['product_id', 'label', 'volume_ml', 'price', 'is_available', 'sort_order'];

    protected function casts(): array
    {
        return ['label' => 'array', 'price' => 'decimal:3', 'is_available' => 'boolean'];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
