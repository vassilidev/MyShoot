<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Shooting extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'shooting_date',
        'nbr_people',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'shooting_date' => 'date',
        'nbr_people'    => 'int',
    ];

    /**
     * @return BelongsToMany
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(People::class)
            ->withTimestamps()
            ->using(PeopleShooting::class)
            ->withPivot(['shoot_at']);
    }

    /**
     * @return BelongsToMany
     */
    public function shootedPeople(): BelongsToMany
    {
        return $this->people()->whereNotNull('shoot_at');
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getFullName(),
        );
    }

    private function getFullName(): string
    {
        return __('Shooting') . ' #' . $this->id . ' - ' . $this->name . ' | ' . $this->shooting_date->format('d/m/Y');
    }

    /**
     * @return Attribute
     */
    public function remainingPeopleCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getRemainingPeopleCount(),
        );
    }

    /**
     * @return int
     */
    private function getRemainingPeopleCount(): int
    {
        return $this->nbr_people - $this->shootedPeople()->count();
    }

    /**
     * @return Attribute
     */
    public function shootPercent(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getShootPercent(),
        );
    }

    /**
     * @return float|int
     */
    private function getShootPercent(): float|int
    {
        if ($this->people()->count()) {
            return ($this->shootedPeople()->count() * 100) / $this->nbr_people;
        }

        return 0;
    }

    /**
     * @return Attribute
     */
    public function directoryName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getDirectoryName(),
        );
    }

    /**
     * @return string
     */
    private function getDirectoryName(): string
    {
        return implode('-', [
            $this->shooting_date->format('Ymd'),
            Str::replace(' ', '-', $this->name),
        ]);
    }
}
