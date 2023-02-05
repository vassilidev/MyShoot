<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class People extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'role_id',
        'gender',
        'name',
        'surname',
        'bip',
        'phone',
        'email',
        'nbr_photos',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'gender'     => GenderEnum::class,
        'nbr_photos' => 'int',
    ];

    /**
     * @return BelongsTo<Role, User>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function shootings(): BelongsToMany
    {
        return $this->belongsToMany(Shooting::class)
            ->withTimestamps()
            ->using(PeopleShooting::class)
            ->withPivot(['shoot_at']);
    }

    /***
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFullName(),
        );
    }

    /**
     * @return string
     */
    private function getFullName(): string
    {
        return $this->name . ' ' . $this->surname . ' | ' . $this->role->name;
    }

    public function getAvatar()
    {
        $files = array_values(
            array_diff(
                scandir(public_path('peoples')),
                ['..', '.']
            )
        );

        $key = collect($files)
            ->search(function ($item) {
                return Str::containsAll(
                    Str::lower($item),
                    [
                        Str::lower($this->name),
                        Str::lower($this->surname),
                    ]
                );
            });

        return ($key !== false) ? 'peoples/' . $files[$key] : 'default.png';
    }
}
