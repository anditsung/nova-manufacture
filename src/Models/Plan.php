<?php

namespace Tsung\NovaManufacture\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tsung\NovaUserManagement\Traits\SaveToUpper;

class Plan extends Model
{
    use SaveToUpper;

    protected $table = "manufacture_plans";

    protected $fillable = [
        'name',
        'abbr',
        'lines',
        'user_id'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFields($query)
    {
        return $query->select('id', 'name', 'lines');
    }
}