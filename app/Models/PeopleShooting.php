<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PeopleShooting extends Pivot
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'people_id',
        'shooting_id',
        'shoot_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'shoot_at' => 'datetime',
    ];

}
