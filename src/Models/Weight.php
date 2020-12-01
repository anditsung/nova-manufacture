<?php

namespace Tsung\NovaManufacture\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $table = 'manufacture_weights';

    protected $fillable = [
        'weight',
        'is_active',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFields($query)
    {
        return $query->select('id', 'weight');
    }
}
