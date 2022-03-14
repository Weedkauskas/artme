<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Magic extends Model
{
    // Panaudojam trait
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $guarded = [];

    /**
     * Magic priklausantys phases relation'ai
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function phrases()
    {
        return $this->hasMany(MagicPhrase::class);
    }

    /**
     * Sluggable modulis
     * @return array
     */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
