<?php

namespace Tsung\NovaManufacture\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tsung\NovaUserManagement\Traits\SaveToUpper;

class Schedule extends Model
{
    use SaveToUpper;

    protected $table = 'manufacture_schedules';

    protected $fillable = [
        'plan_id',
        'line',
        'start',
        'finish',
        'product_id',
        'type_id',
        'surface_id',
        'color_id',
        'user_id',
    ];

    protected $casts = [
        'start' => 'datetime',
        'finish' => 'datetime',
    ];

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function surface() : BelongsTo
    {
        return $this->belongsTo(Surface::class);
    }

    public function color() : BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
}
