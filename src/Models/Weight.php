<?php

namespace Tsung\NovaManufacture\Models;


use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'manufacture_weights';

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function scopeFields($query)
    {
        return $query->select('id', 'name');
    }
}
