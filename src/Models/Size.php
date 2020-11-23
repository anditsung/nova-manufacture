<?php

namespace Tsung\NovaManufacture\Models;

use Illuminate\Database\Eloquent\Model;
use Tsung\NovaUserManagement\Traits\SaveToUpper;

class Size extends Model
{
    use SaveToUpper;

    protected $table = 'manufacture_sizes';

    protected $fillable = [
        'name',
    ];

    public function scopeFields($query)
    {
        return $query->select('id', 'name');
    }
}
