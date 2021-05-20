<?php

namespace Tsung\NovaManufacture\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Tsung\NovaUserManagement\Traits\SaveToUpper;

class ProductType extends Model
{
    use SaveToUpper;

    protected $table = "manufacture_product_types";

    protected $fillable = [
        'name',
        'product_id',
        'size_id',
        'color_id',
        'surface_id',
        'weight_id',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating( function ($model) {

            $model->validateProductType();

        });
    }

    public function validateProductType()
    {
        $productName = "{$this->product->code}-{$this->surface->code}-{$this->color->code}-{$this->weight->code}{$this->size->code}";

        $exists = self::where('name', $productName)->first();

        if ($exists) {
            throw ValidationException::withMessages(['product' => "product type {$productName} already exist"]);
        }

        $this->name = $productName;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function surface()
    {
        return $this->belongsTo(Surface::class);
    }

    public function weight()
    {
        return $this->belongsTo(Weight::class);
    }
}
