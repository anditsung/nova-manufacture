<?php

namespace Tsung\NovaManufacture\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tsung\NovaUserManagement\Traits\SaveToUpper;

class Surface extends Model
{
    use SaveToUpper;

    protected $table = 'manufacture_surfaces';

    protected $fillable = [
        'code',
        'name',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function scopeFields($query)
    {
        return $query->select('id', 'name');
    }
}
